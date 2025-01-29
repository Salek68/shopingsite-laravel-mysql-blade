<?php

namespace App\Http\Controllers;

use App\Models\CategoryZirMenu;
use App\Models\galery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
    function index(Request $req,$id){

        $product = DB::table('products as p')
    ->join('category_zir_menu as czm', 'p.category_id', '=', 'czm.id')
    ->select('p.id', 'p.name', 'p.description', 'p.price', 'p.discount', 'p.final_price', 'p.sku', 'p.category_id', 'p.stock', 'p.sold', 'p.view', 'p.image', 'p.status', 'p.is_featured', 'p.created_at', 'p.updated_at', 'p.deleted_at', 'czm.name as category_name','czm.id as category_id')
    ->where('p.id',$id)
    ->get();
    $product = $product[0];
    $galery = galery::where('product_id',$id)->get();
    $rlated = Product::where('category_id',$product->category_id) ->where('id', '!=', $product->id)->get();

    $vigeis = DB::table('vigeiproduct')
    ->join('vigeiha', 'vigeiproduct.vigei_id', '=', 'vigeiha.id')
    ->where('vigeiproduct.product_id', $id)
    ->select('vigeiha.name', 'vigeiproduct.description')
    ->get();


            return view('product', compact('product','galery','rlated','vigeis'));


    }


}
