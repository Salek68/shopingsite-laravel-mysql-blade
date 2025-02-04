<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PanelAdmin extends Controller
{
    function index(Request $req ){
        $orders = Order::with('items')->get();
        // dd($orders);
    return view('admin.PanelAdmin',compact('orders'));


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
