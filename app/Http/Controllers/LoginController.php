<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

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
            if($user->password == md5($req['password'])){
                if($user->isadmin =='1'){
                    if($user->status =='1'){
                        session([
                            'user_name' => Crypt::encrypt($user->name),
                            'user_role' => Crypt::encrypt('admin')
                        ]);
                        $orders = Order::with('items')->get();
                    return view('admin.PanelAdmin' , compact( 'orders'));
                    }
                    else{
                        return back()->withErrors([
                            'status' => "3کاربر با این یوزر پسورد موجود نیست یا غیر فعال است"
                        ]);
                    }
                }
                else{

                    ///// بره به پنل کاربری یوزر ساده

                }
            }
            else{
                return back()->withErrors([
                    'status' => "123کاربر با این یوزر پسورد موجود نیست یا غیر فعال است"
                ]);
            }
        }
        else{
            return back()->withErrors([
                'status' => "2کاربر با این یوزر پسورد موجود نیست یا غیر فعال است"
            ]);
        }
        return view('Login');
    }
}
