<?php

namespace App\Http\Controllers;

use App\Models\AdminPos;
use App\Models\User;
use App\Models\Order;
use App\Models\Positions;
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
            if(Hash::check($req['password'] , $user->password )){
                if($user->isadmin =='1'){
                    if($user->status =='1'){
                        $pos = AdminPos::where('admin_id', $user->id)  // فیلتر ادمین با id برابر با $user->id
                        ->with('positions')  // لود پوزیشن‌های مرتبط
                        ->get();  // گرفتن تمام نتایج
                        $positionIds = $pos->pluck('positions')->flatten();
                        foreach($positionIds as $item){
                            if($item->pos == "all"){
                           $positionIds = Positions::all();
                           session([
                            'user_name' => Crypt::encrypt($user->name),
                            'user_role' => Crypt::encrypt('admin'),
                            'user_ac' => $positionIds,
                            'ac' => true
                        ]);
                        }
                        else{
                            session([
                                'user_name' => Crypt::encrypt($user->name),
                                'user_role' => Crypt::encrypt('admin'),
                                'user_ac' => $positionIds,
                                'ac' => false
                            ]);
                        }
                        }



                        // dd(session('user_ac'));
                        $orders = Order::with('items')->get();

                        return redirect()->route('AdminPanel.index')->with('orders',  $orders);
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
                    'status' => "2کاربر با این یوزر پسورد موجود نیست یا غیر فعال است"
                ]);
            }
        }
        else{
            return back()->withErrors([
                'status' => "1کاربر با این یوزر پسورد موجود نیست یا غیر فعال است"
            ]);
        }
        return view('Login');
    }
}
