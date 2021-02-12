<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function index(){
        $banks = Bank::all();
        return view('admin.bank.index',compact(['banks']));
    }

    public function create(){
        return view('admin.bank.create');
    }

    public function doCreate(BankRequest $request){
        DB::beginTransaction();
        try{
            $bank = new Bank();
            $filepath = "";
            $bank->name = $request->name;
            $bank->mobile = $request->mobile;
            $bank->email = $request->email;
            $bank->website = $request->website;
            $bank->id = $request->id;
            $filepath = saveImage('banks', $request->image);
            $bank->image = $filepath;
            $bank->save();
            DB::commit();
            toastr()->success('The bank has been created.', 'Bank Create');
            return redirect()->route('admin.bank.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Bank Create');
            return redirect()->route('admin.bank.index');
        }
    }

    public function edit($bankId){
        try {
            $bank = Bank::find($bankId);
            if(!$bank){
                toastr()->error('The bank does not exist.', 'Bank Edit');
                return redirect()->route('admin.bank.index');
            }
            return view('admin.bank.edit',compact(['bank']));
        }catch (\Exception $e){
            toastr()->warning('There is an error please try again later.', 'Bank Edit');
            return redirect()->route('admin.bank.index');
        }
    }

    public function doEdit(BankRequest $request, $bankId){;
        DB::beginTransaction();
        try{
            $bank = Bank::find($bankId);
            if(!$bank){
                toastr()->error('The bank does not exist.', 'Bank Edit');
                return redirect()->route('admin.bank.index');
            }
            $filepath = "";
            $oldImage = $bank->image;
            $bank->name = $request->name;
            $bank->mobile = $request->mobile;
            $bank->email = $request->email;
            $bank->website = $request->website;
            $bank->id = $request->id;
            if ($request->has('image')) {
                $filepath = saveImage('banks', $request->image);
                $bank->image = $filepath;
            }
            $bank->save();
            if($request->has('image')){try {deleteImage($oldImage);}catch (\Exception $e){}}
            DB::commit();
            toastr()->success('The bank information has been updated.', 'Bank Edit');
            return redirect()->route('admin.bank.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Bank Edit');
            return redirect()->route('admin.bank.index');
        }
    }

    public function delete($bankId){
        DB::beginTransaction();
        try{
            $bank = Bank::find($bankId);
            if(!$bank){
                toastr()->error('The bank does not exist.', 'Bank Delete');
                return redirect()->route('admin.bank.index');
            }
            $oldImage = $bank->image;
            $bank->delete();
            if($oldImage){try {deleteImage($oldImage);}catch (\Exception $e){}}
            DB::commit();
            toastr()->success('The bank has been deleted.', 'Bank Delete');
            return redirect()->route('admin.bank.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Bank Delete');
            return redirect()->route('admin.bank.index');
        }
    }

    public function status($bankId){
        $bank = Bank::find($bankId);
        if(!$bank){
            toastr()->error('The bank does not exist.', 'Bank Status');
            return redirect()->route('admin.bank.index');
        }
        $bank->status = ($bank->status == 0)? 1 : 0;
        $bank->save();
        toastr()->success('The bank status has been changed.', 'Bank Status');
        return redirect()->route('admin.bank.index');
    }
}
