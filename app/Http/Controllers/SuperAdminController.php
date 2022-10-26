<?php

namespace App\Http\Controllers;

use Error;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function dashboard(Request $request)
    {
        try{
            $adminCount = User::where(['role' => 'admin'])->whereIn('status', ['active','inactive'])->count();
            $userCount = User::where(['role' => 'user'])->whereIn('status', ['active','inactive'])->count();
            return view('superadmin/dashboard',compact('adminCount','userCount'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function admins(Request $request)
    {
        try{
            $admins = User::where(['parent' => Auth::user()->id,'role' => 'admin'])->whereIn('status', ['active','inactive'])->get();
            return view('superadmin/admins', compact('admins'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function admin(Request $request, $id=null){
        $user = null;
        try {
            if ($request->isMethod('post')){
                if($request->id && $request->id != ""){
                    $Valid = [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->id],
                    ];
                } else {
                    $Valid = [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'confirmed'],
                    ];
                }
                $validator = Validator::make($request->all(), $Valid);
                if($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                if($request->id && $request->id != ""){
                    $user = User::find($request->id);
                    $user->name = is_null($request->name) ? $user->name : $request->name;
                    $user->email = is_null($request->email) ? $user->email : $request->email;
                    $user->status = is_null($request->status) ? $user->status : $request->status;
                    if(!is_null($request->password)){
                        if(trim($request->password) != trim($request->password_confirmation)){
                            throw new Error('New password and confirm password should be same.');
                        }
                        $user->password = Hash::make(trim($request->password));
                    }
                    $user->save();
                    $msg = "Updated successfully";
                } else {
                    User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make(trim($request->password)),
                        'status' => $request->status,
                        'role' => 'admin',
                        'parent' => Auth::user()->id,
                    ]);
                    $msg = "Added successfully";
                }
                return redirect()->route('superadmin.admins')->with('success',$msg);
            } else {
                if($id){
                    $user = User::where('id',$id)->first();
                }
                if($user && $request->action && $request->action == 'delete'){
                    $user->status = 'deleted';
                    $user->email  = $user->email.'__DELETED__'.\Carbon\Carbon::parse()->format('Y-m-d H:i:s');
                    $user->save();
                    return redirect()->route('superadmin.admins')->with('success',"Deleted successfully");
                }
                return view('superadmin.admin',compact('user'));
            }
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
     
}
