<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Error;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        try{
            return view('user/dashboard');
        } catch (\Throwable $th) {
            return redirect('/')->with('error',$th->getMessage());
        }
    }
}
