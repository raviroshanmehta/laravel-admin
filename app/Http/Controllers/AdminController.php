<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Error;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->role != 'admin'){
                return redirect('/'.Auth::user()->role.'/dashboard')->with('error','You are not authorized to access this location.');
            }
            return $next($request);
        });
    }

    public function dashboard(Request $request)
    {
        try{
            $userCount = User::where(['parent' => Auth::user()->id,'role' => 'user'])->whereIn('status', ['active','inactive'])->count();
            return view('admin/dashboard',compact('userCount'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function users(Request $request)
    {
        try{
            $users = User::where(['parent' => Auth::user()->id,'role' => 'user'])->whereIn('status', ['active','inactive'])->get();
            return view('admin/users',compact('users'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

     public function user(Request $request, $id=null){
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
                        'role' => 'user',
                        'parent' => Auth::user()->id,
                    ]);
                    $msg = "Added successfully";
                }
                return redirect()->route('admin.users')->with('success',$msg);
            } else {
                if($id){
                    $user = User::where('id',$id)->first();
                }
                if($user && $request->action && $request->action == 'delete'){
                    $user->status = 'deleted';
                    $user->email  = $user->email.'__DELETED__'.\Carbon\Carbon::parse()->format('Y-m-d H:i:s');
                    $user->save();
                    return redirect()->route('admin.users')->with('success',"Deleted successfully");
                }
                return view('admin.user',compact('user'));
            }
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
}
