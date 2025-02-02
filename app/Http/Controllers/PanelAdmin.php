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
}
