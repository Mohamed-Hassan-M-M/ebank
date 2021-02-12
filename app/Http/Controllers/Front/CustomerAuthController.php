<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerAuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('web')->attempt(['email' => $request->input("email"),'password' => $request->input("password")], $remember_me)) {
            if(Auth::user()->status != 0)
                toastr()->success('You are sign in.', Auth::user()->username);
            return redirect() -> route('account.index');
        }
        toastr()->error('Error, Try another email or password.', 'User login');
        return redirect()->back()->with(['error'=>'Try another email or password.']);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('website.home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(CustomerRequest $request)
    {
        DB::beginTransaction();
        try{
            $customer = new User();
            $filepath = "";
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->username = $request->username;
            $customer->password = $request->password;
            $filepath = saveImage('customers', $request->image);
            $customer->image = $filepath;
            $customer->save();
            $customer->sendEmailVerificationNotification();
            $remember_me = $request->has('remember_me') ? true : false;
            auth()->guard('web')->attempt(['email' => $request->input("email"),'password' => $request->input("password")], $remember_me);
            toastr()->warning('Verify your account.', $request->name);
            DB::commit();
            return redirect()->route('verification.notice');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', $request->name);
            return redirect()->route('user.register');
        }
    }
}
