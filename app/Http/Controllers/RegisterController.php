<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class RegisterController extends Controller
{
    function index()
    {

        return view('Register');
    }
    function save(Request $request)
    {


        $user = User::where('email', $request['email'])->first();

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
                $user->password  = Hash::make($request['password']) ;
                $user->save();
                $mess = "ثبت نام باموفقیت انجام شد.";
                return view('Login', compact('mess'));
            } catch (\Throwable $th) {

            }
        }
    }
}
