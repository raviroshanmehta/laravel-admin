<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Error;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try{
            return redirect('/'.Auth::user()->role.'/dashboard');
        } catch (\Throwable $th) {
            return redirect('/')->with('error',$th->getMessage());
        }
    }

    public function password(Request $request) 
    {
        try{
            $validater=Validator::make($request->all(),[
                'oldPass'=>'required',
                'newPass'=>'required',
                'confPass'=>'required',
            ]);
            if($validater->fails()){
                return back()->withErrors($validater);
            }
            if(trim($request->newPass) != trim($request->confPass)){
                throw new Error('New password and confirm password should be same.');
            }

            $user = Auth::user();
            if (Hash::check(trim($request->oldPass), $user->password)) { 
                $user->update([
                    'password' => Hash::make(trim($request->newPass))
                ]);
            } else{
                return back()->with("error","Old password not matched");
            }
            return redirect()->route(''.$user->role.'.dashboard')->with(['success'=>'Password has been updated successfully.']);
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function profile(Request $request){
        try{
            $Valid = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.Auth::user()->id
            ];
            $validator = Validator::make($request->all(), $Valid);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = User::find(Auth::user()->id);
            $user->name = is_null($request->name) ? "" : $request->name;
            $user->email = is_null($request->email) ? "" : $request->email;
            $user->save();
            
            return redirect()->route(''.$user->role.'.dashboard')->with('success', 'Profile has been updated successfully.');

        } catch (\Throwable $th) {
            return redirect('/'.Auth::user()->role.'')->with('error',$th->getMessage());
        }
    }
}
