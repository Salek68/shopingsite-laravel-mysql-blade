<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PanelAdmin extends Controller
{
    function index(Request $req ){



        $hashedRole = Crypt::decrypt(session('user_role'));
        if ($hashedRole) {
             $orders = Order::with('items')->get();
        // dd($orders);
    return view('admin.PanelAdmin',compact('orders'));
        } else{
            return view('Login');
        }




    }
    function Users(Request $req ){
    $user = User::all();
    $admins = 0;
    $all = 1;

    return view('admin.AdminUsers',compact('user','admins','all'));


    }
    function Users_admins(Request $req ){
        $user = User::where('isadmin' ,'1')->get();
        $admins = 1;
        $all = 0;

        return view('admin.AdminUsers',compact('user','admins','all'));

        }

        function Users_serech(Request $req ){
            $query = User::query(); // شروع کوئری

            if (!empty($req->name)) {
                $query->where('name', 'like', "%{$req->name}%");
            }

            if (!empty($req->email)) {
                $query->orWhere('email', 'like', "%{$req->email}%");
            }

            $user = $query->get();

            $admins = 0;
            $all = 1;

            return view('admin.AdminUsers',compact('user','admins','all'));

            }
    function Users_remove(Request $req , $id){
        $user = User::find($id);
        // dd($orders);
        $user->delete();


        $user = User::all();

        $admins = 0;
        $all = 1;

        return view('admin.AdminUsers',compact('user','admins','all'));


    }
    function Users_status(Request $req , $id){
        $user = User::find($id);

        if( $user->status == 0) {
            $user->status = 1;
          }
          else{
            $user->status = 0;
          }
          $user->save();


        $user = User::all();

        $admins = 0;
        $all = 1;

        return view('admin.AdminUsers',compact('user','admins','all'));


    }

    function OrderRemove(Request $req , $id){
        $orders = Order::find($id);
        // dd($orders);
        $orders->delete();
        $orders = Order::with('items')->get();
        // dd($orders);
    return view('admin.PanelAdmin',compact('orders'));


    }

    function OrderEdit(Request $req , $id){
        $orders = Order::find($id);
        // dd($orders);
      if( $orders->status == 0) {
        $orders->status = 1;
      }
      else{
        $orders->status = 0;
      }
      $orders->save();
        $orders = Order::with('items')->get();
        // dd($orders);
    return view('admin.PanelAdmin',compact('orders'));


    }
}
