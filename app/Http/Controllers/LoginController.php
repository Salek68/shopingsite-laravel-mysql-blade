<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index(){

        return view('Login');
    }
    function index1(Request $req){
        $req->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $user = User::where('email', $req['email'])->first();

        if (optional($user)->id){
            if($user->password == $req['password']){
                dd('ok');
            }
            else{
                dd('pass eror');
            }
        }
        else{
            dd('user not fonud');
        }
        return view('Login');
    }
}
