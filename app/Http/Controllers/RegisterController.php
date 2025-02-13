<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    function index()
    {

        return view('Register');
    }
    function save(Request $request)
    {





        $uid =  Crypt::decrypt(session('user_id'));
        $usero = User::find($uid);
        $user = User::where('email', $request['email'])->first();
        if (  $chenge = trim($request->input("chenge\r\n")) == "chenge") {
            $request->validate([
                'email' => 'email|required',
                'pass' => 'required',
            ]);
            if (optional($user)->id && $usero->email != $request['email']) {


                $erorr2 = "این ایمیل قبلا ثبت شده است !";
                return back()->withErrors([
                    'email' => $erorr2
                ]);


        } else {
            if ($request['passver'] != $request['pass']) {
                $erorr1 = "کلمه عبور با تایید ان مطابقت ندارد";

                return back()->withErrors([
                    'dup' => $erorr1
                ]);
            }else{
                $uid =  Crypt::decrypt(session('user_id'));
                $user = User::find($uid);
                $user->name  = $request['name'];
                $user->email  = $request['email'];
                $user->password  = Hash::make($request['pass']);
                $user->save();
                $mess = "تغییرات  باموفقیت انجام شد.";
                return view('Login', compact('mess'));
            }



        }


        }
        else{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);
            if (optional($user)->id) {


                $erorr2 = "این ایمیل قبلا ثبت شده است !";
                return back()->withErrors([
                    'email' => $erorr2
                ]);
                if ($request['password_confirmation'] != $request['password']) {
                    $erorr1 = "کلمه عبور با تایید ان مطابقت ندارد";

                    return back()->withErrors([
                        'dup' => $erorr1
                    ]);
                }

        } else {
            try {

                $user = new User();
                $user->name  = $request['name'];
                $user->email  = $request['email'];
                $user->password  = Hash::make($request['password']);
                $user->save();
                $mess = "ثبت نام باموفقیت انجام شد.";
                return view('Login', compact('mess'));
            } catch (\Throwable $th) {
            }
        }
        }

    }
}
