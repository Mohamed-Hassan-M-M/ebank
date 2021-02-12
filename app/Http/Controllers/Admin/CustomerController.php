<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerStatus;

class CustomerController extends Controller
{
    public function index(){
        $customers = User::all();
        return view('admin.customer.index',compact(['customers']));
    }

    public function status($customerId){
        $customer = User::find($customerId);
        if(!$customer){
            toastr()->error('The customer does not exist.', 'Customer Status');
            return redirect()->route('admin.customer.index');
        }
        $customer->status = ($customer->status == 0)? 1 : 0;
        $customerMail = new CustomerStatus($customer);
        $to = $customer->email;
        $customer->save();
        Mail::to($to)->send($customerMail);
        toastr()->success('The customer status has been changed.', 'Customer Status');
        return redirect()->route('admin.customer.index');
    }
}
