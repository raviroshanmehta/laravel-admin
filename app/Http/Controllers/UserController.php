<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Error;
use Auth;
use App\Models\User;

class UserController extends Controller
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
            if(Auth::user()->role != 'user'){
                return redirect('/'.Auth::user()->role.'/dashboard')->with('error','You are not authorized to access this location.');
            }
            return $next($request);
        });
    }

    public function dashboard(Request $request)
    {
        try{
            return view('user/dashboard');
        } catch (\Throwable $th) {
            return redirect('/')->with('error',$th->getMessage());
        }
    }
}
