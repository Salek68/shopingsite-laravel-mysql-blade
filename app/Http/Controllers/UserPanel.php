<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserPanel extends Controller
{
    public function checkuser($req)
    {
        if ($req->is('*UserPanel*')) {

            if (!session('user_role')) {
                return false;
            } else {
                if (Crypt::decrypt(session('user_role')) != 'user') {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
    function index(Request $req)
    {

        if ($this->checkuser($req) == false) {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        } else {
            $uid= Crypt::decrypt(session('user_id'));
            $orders = Order::with('items')->where('user_id' ,$uid )->get();
            $is_active = 1;
            // dd($orders);
             return view('PanelUser', compact('orders', 'is_active'));
        }
    }

    function UserInfo(Request $req,$id)
    {

        if ($this->checkuser($req) == false) {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        } else {
           $uid = Crypt::decrypt(session('user_id'));
            if($id == $uid){
                $is_active = 2;
                $user = User::find($id);
                return view('UserInformation', compact('is_active','user'));
            }
            else{
                return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
            }

        }
    }

    function Orders_remove(Request $req, $id)
    {
        if ($this->checkuser($req)) {
        $uid= Crypt::decrypt(session('user_id'));
        $orders = Order::find($id);
        $orderitem = Order::with(['items'])->find($id);
        if($orders->user_id == $uid){

            if($orders->status >=2){
                foreach ($orderitem->items as $item) {
                    $Products = Product::find($item->product_id);
                    $Products->sold =  $Products->sold - $item->quantity;
                    $Products->save();
                }
            }

            $orders->status = -1;
            $orders->save();
        }


        $orders = Order::with('items')->get();
        // dd($orders);
        return redirect()->route('UserPanel.index');
    } else {
        return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
    }
    }


}
