<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CustomerAccount;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index(){
        return view('front.customer.home');
    }

    public function manageaccount(){
        return view('front.website.home');
    }

    public function ourservice(){
        $accountBanks = CustomerAccount::with('banks')->where('customer_id',Auth::user()->id)->get();
        return view('front.customer.service',compact(['accountBanks']));
    }

    public function transaction(){
        $transactions = Transaction::where('sender_id',Auth::user()->id)->orWhere('receiver_id',Auth::user()->id)->get();
        return view('front.customer.transaction',compact(['transactions']));
    }

    public function doWithdrawal(Request $request){

        $user = User::find(Auth::user()->id);

        $account = CustomerAccount::where('account_id',$request->account_id)->where('customer_id',Auth::user()->id)->first();

        if(!$account)
            return redirect()->route('account.ourservice')->with(['message'=>'This account not belong to you.','status'=>'error']);

        $accoun_bank = Account::find($request->account_id);

        if(!$accoun_bank)
            return redirect()->route('account.ourservice')->with(['message'=>'The account not found.','status'=>'error']);

        if(!isset($accoun_bank->banks) || $accoun_bank->banks == null)
            return redirect()->route('account.ourservice')->with(['message'=>'We not deal with this bank.','status'=>'error']);

        if($accoun_bank->balance < $request->amount)
            return redirect()->route('account.ourservice')->with(['message'=>'Your balance not enough.','status'=>'error']);

        if(Auth::guard('web')->validate(['email'=>Auth::user()->email, 'password'=>$request->password]))
            return redirect()->route('account.ourservice')->with(['message'=>'The password is incorrect.','status'=>'error']);

        $accoun_bank->balance -= $request->amount;
        $user->balance += $request->amount;

        try {
            DB::beginTransaction();
            $accoun_bank->save();
            $user->save();
            DB::commit();
            return redirect()->route('account.ourservice')->with(['message'=>'The transaction done successfully.','status'=>'success']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('account.ourservice')->with(['message'=>'The transaction failed, please try again.','status'=>'error']);
        }
    }

    public function dpDeposit(Request $request){

        $user = User::find(Auth::user()->id);

        $account = CustomerAccount::where('account_id',$request->account_id)->where('customer_id',Auth::user()->id)->first();

        if(!$account)
            return redirect()->route('account.ourservice')->with(['message'=>'This account not belong to you.','status'=>'error']);

        $accoun_bank = Account::find($request->account_id);

        if(!$accoun_bank)
            return redirect()->route('account.ourservice')->with(['message'=>'The account not found.','status'=>'error']);

        if(!isset($accoun_bank->banks) || $accoun_bank->banks == null)
            return redirect()->route('account.ourservice')->with(['message'=>'We not deal with this bank.','status'=>'error']);

        if($user->balance < $request->amount)
            return redirect()->route('account.ourservice')->with(['message'=>'Your balance not enough.','status'=>'error']);

        if(Auth::guard('web')->validate(['email'=>Auth::user()->email, 'password'=>$request->password]))
            return redirect()->route('account.ourservice')->with(['message'=>'The password is incorrect.','status'=>'error']);

        $accoun_bank->balance += $request->amount;
        $user->balance -= $request->amount;

        try {
            DB::beginTransaction();
            $accoun_bank->save();
            $user->save();
            DB::commit();
            return redirect()->route('account.ourservice')->with(['message'=>'The transaction done successfully.','status'=>'success']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('account.ourservice')->with(['message'=>'The transaction failed, please try again.','status'=>'error']);
        }
    }

    public function doLink(Request $request){
        $accoun_bank = Account::find($request->account_id);
        $account_exists = CustomerAccount::where('account_id',$request->account_id)->first();
        if(!$accoun_bank)
            return redirect()->route('account.ourservice')->with(['message'=>'The account not found.','status'=>'error']);
        if(!isset($accoun_bank->banks) || $accoun_bank->banks == null)
            return redirect()->route('account.ourservice')->with(['message'=>'We not deal with this bank.','status'=>'error']);
        if($account_exists)
            return redirect()->route('account.ourservice')->with(['message'=>'This account already linked.','status'=>'error']);
        if($accoun_bank->password !=  $request->password)
            return redirect()->route('account.ourservice')->with(['message'=>'The password is incorrect.','status'=>'error']);
        CustomerAccount::create([
            'customer_id'=>Auth::user()->id,
            'account_id'=>$request->account_id,
            'bank_id'=>$accoun_bank->bank_id,
        ]);
        return redirect()->route('account.ourservice')->with(['message'=>'The account linked successfully.','status'=>'success']);
    }

    public function unlink($account_id){
        $account = CustomerAccount::where('account_id',$account_id)->where('customer_id',Auth::user()->id)->first();
        if(!$account)
            return redirect()->route('account.ourservice')->with(['message'=>'The account not found.','status'=>'error']);
        try {
            DB::delete('delete from customer_accounts where account_id='.$account_id);
            return redirect()->route('account.ourservice')->with(['message'=>'The account unlink successfully.','status'=>'success']);
        }catch (\Exception $e){
            return redirect()->route('account.ourservice')->with(['message'=>'The unlink failed try again later.','status'=>'error']);
        }
    }

    public function transfer(){
        return view('front.customer.transfer');
    }

    public function transferCheckEmail(Request $request){
        $receiver = User::where('email',$request->email)->first();
        if(!$receiver){
            return response()->json([
                'message'=>'This email does not exist.',
                'emailstatus'=>'error',
            ]);
        }
        if($request->email == Auth::user()->email){
            return response()->json([
                'message'=>'You can not transfer to your email.',
                'emailstatus'=>'error',
            ]);
        }
        return response()->json([
            'emailstatus'=>'success',
            'image'=>$receiver->image,
            'username'=>$receiver->username,
            'mobile'=>$receiver->mobile,
            'email'=>$receiver->email,
        ]);
    }

    public function transferCheckAmount(Request $request){
        $sender = User::find(Auth::user()->id);
        if($request->amount <= 0){
            return response()->json([
                'message'=>'Enter a correct amount.',
                'amountstatus'=>'error',
            ]);
        }
        if($sender->balance < $request->amount){
            return response()->json([
                'message'=>'Your balance less than the amount.',
                'amountstatus'=>'error',
            ]);
        }
        if(Auth::guard('web')->validate(['email'=>$sender->email,'password'=>$sender->password])){
            return response()->json([
                'message'=>'Your password is incorrect.',
                'amountstatus'=>'error',
            ]);
        }
        return response()->json([
            'amountstatus'=>'success',
        ]);
    }

    public function doTransfer(Request $request){

        $sender = User::find(Auth::user()->id);
        $receiver = User::where('email',$request->email)->first();

        if(!$receiver || $request->email == Auth::user()->email)
            return redirect()->route('account.transfer')->with(['message'=>'The transaction failed.','status'=>'error']);

        if($request->amount <= 0 || $sender->balance < $request->amount || $receiver->status == 0 || !Auth::guard('web')->validate(['email'=>Auth::user()->email, 'password'=>$request->password])){
            Transaction::create([
                'sender_id'=>$sender->id,
                'receiver_id'=>$receiver->id,
                'amount'=>$request->amount,
                'status'=>0,
                'details'=>$request->has('details')? $request->details : '',
            ]);
            return redirect()->route('account.transfer')->with(['message'=>'The transaction failed.','status'=>'error']);
        }

        try {
            DB::beginTransaction();
            $sender->balance -= $request->amount;
            $receiver->balance += $request->amount;
            $sender->save();
            $receiver->save();
            Transaction::create([
                'sender_id'=>$sender->id,
                'receiver_id'=>$receiver->id,
                'amount'=>$request->amount,
                'status'=>1,
                'details'=>$request->has('details')? $request->details : '',
            ]);
            DB::commit();
            return redirect()->route('account.transfer')->with(['message'=>'The transaction done successfully.','status'=>'success']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('account.transfer')->with(['message'=>'The transaction failed, please try again.','status'=>'error']);
        }
    }

}
