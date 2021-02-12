<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"),'password' => $request->input("password")], $remember_me)) {
            toastr()->success('You are sign in.', 'Admin login');
            return redirect() -> route('admin.dashboard');
        }
        toastr()->error('Error, Try another email or password.', 'Admin login');
        return redirect()->back()->with(['error'=>'Try another email or password.']);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return view('auth.login');
    }
}
