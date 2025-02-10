<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PanelAdmin extends Controller
{

    public function checkadmin($req){
        if($req->is('*AdminPanel*')){

            if (!session('user_role') ) {
                     return false;
                }
                else{
                    if( Crypt::decrypt(session('user_role')) != 'admin'){
                        return false;
                    } else{
                        return true;
                    }

                }
        }


     }
    function index(Request $req ){

        if ($this->checkadmin($req) == false) {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
        else{
            $orders = Order::with('items')->get();
            $is_active = 1;
            // dd($orders);
        return view('admin.PanelAdmin',compact('orders','is_active'));
        }






    }
    function Users(Request $req ){

      if($this->checkadmin($req)){

        $user = User::all();
        $admins = 0;
        $all = 1;
        $is_active = 3;
        return view('admin.AdminUsers',compact('user','admins','all','is_active'));
      }
      else{
        return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
      }






    }
    function Users_admins(Request $req ){

        if($this->checkadmin($req)){

            $user = User::where('isadmin' ,'1')->get();
            $admins = 1;
            $all = 0;
            $is_active = 3;
            return view('admin.AdminUsers',compact('user','admins','all','is_active'));
          }
          else{
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
          }


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
    function Users_logaout(Request $req){

// پاک کردن سشن و خروج کاربر
session()->invalidate();
return  redirect()->route('Login.index');


    }


 function Products(Request $req ){

      if($this->checkadmin($req)){

        $Products = DB::select("
        SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
               s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
               s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
               s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
        FROM laravel.category_zir_menu u
        INNER JOIN laravel.products s ON s.category_id = u.id
    ");

        $stoke = 0;
        $notstoke = 0;
        $is_active = 2;
        return view('admin.AdminPrroducts',compact('Products','notstoke','stoke','is_active'));
      }
      else{
        return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
      }






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
