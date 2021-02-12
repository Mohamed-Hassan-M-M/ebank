<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin.admin.index',compact(['admins']));
    }

    public function create(){
        return view('admin.admin.create');
    }

    public function doCreate(AdminRequest $request){
        DB::beginTransaction();
        try{
            $admin = new Admin();
            $filepath = "";
            $admin->name = $request->name;
            $admin->mobile = $request->mobile;
            $admin->email = $request->email;
            $admin->username = $request->username;
            $admin->password = $request->password;
            $filepath = saveImage('admins', $request->image);
            $admin->image = $filepath;
            $admin->save();
            DB::commit();
            toastr()->success('The admin has been created.', 'Admin Create');
            return redirect()->route('admin.admin.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Admin Create');
            return redirect()->route('admin.admin.index');
        }
    }

    public function edit($adminID){
        try {
            $admin = Admin::find($adminID);
            if(!$admin){
                toastr()->error('The admin does not exist.', 'Admin Edit');
                return redirect()->route('admin.admin.index');
            }
            return view('admin.admin.edit',compact(['admin']));
        }catch (\Exception $e){
            toastr()->warning('There is an error please try again later.', 'Admin Edit');
            return redirect()->route('admin.admin.index');
        }
    }

    public function doEdit(BankRequest $request, $adminID){;
        DB::beginTransaction();
        try{
            $admin = Admin::find($adminID);
            if(!$admin){
                toastr()->error('The admin does not exist.', 'Admin Edit');
                return redirect()->route('admin.admin.index');
            }
            $filepath = "";
            $oldImage = $admin->image;
            $admin->name = $request->name;
            $admin->mobile = $request->mobile;
            $admin->email = $request->email;
            $admin->username = $request->username;
            $admin->password = $request->password;
            $admin->id = $request->id;
            if ($request->has('image')) {
                $filepath = saveImage('admins', $request->image);
                $admin->image = $filepath;
            }
            $admin->save();
            if($request->has('image')){try {deleteImage($oldImage);}catch (\Exception $e){}}
            DB::commit();
            toastr()->success('The admin information has been updated.', 'Admin Edit');
            return redirect()->route('admin.admin.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Admin Edit');
            return redirect()->route('admin.admin.index');
        }
    }

    public function delete($adminID){
        DB::beginTransaction();
        try{
            $admin = Admin::find($adminID);
            if(!$admin){
                toastr()->error('The admin does not exist.', 'Admin Delete');
                return redirect()->route('admin.admin.index');
            }
            $oldImage = $admin->image;
            $admin->delete();
            if($oldImage){try {deleteImage($oldImage);}catch (\Exception $e){}}
            DB::commit();
            toastr()->success('The admin has been deleted.', 'Admin Delete');
            return redirect()->route('admin.admin.index');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->warning('There is an error please try again later.', 'Admin Delete');
            return redirect()->route('admin.admin.index');
        }
    }

    public function status($adminID){
        $admin = Admin::find($adminID);
        if(!$admin){
            toastr()->error('The admin does not exist.', 'Admin Status');
            return redirect()->route('admin.admin.index');
        }
        $admin->status = ($admin->status == 0)? 1 : 0;
        $admin->save();
        toastr()->success('The admin status has been changed.', 'Admin Status');
        return redirect()->route('admin.admin.index');
    }
}
