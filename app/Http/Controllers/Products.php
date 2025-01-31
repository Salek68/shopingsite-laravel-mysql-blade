<?php

namespace App\Http\Controllers;

use App\Models\CategoryZirMenu;
use App\Models\CommentProduct;
use App\Models\galery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

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



    $Comments = DB::table('comment_product')
    ->join('products', 'comment_product.product_id', '=', 'products.id')
    ->where('comment_product.product_id', $id)
    ->where('comment_product.verify', 1)
    ->select('comment_product.id','comment_product.comment','comment_product.product_id','comment_product.like','comment_product.dislike')
    ->get();

     $view = Product::find($id);
     $view->increment('view');


            return view('product', compact('product','galery','rlated','vigeis','Comments'));


    }

    function update(Request $req, $id,$name){
        if($name == "like"){

            try {
                // پیدا کردن کامنت با استفاده از ID
                $comment = CommentProduct::find($id);

                // اگر کامنت یافت نشد، پیام خطا بده
                if (!$comment) {
                    return response()->json([
                        'success' => false,
                        'message' => 'کامنت با این ID یافت نشد'
                    ], 404);
                }

                // اگر مقدار like برابر با null بود، آن را به 0 تنظیم می‌کنیم
                if ($comment->like === null) {
                    $comment->like = 0;
                }

                // افزایش مقدار like
                $comment->increment('like');

                return response()->json([
                    'success' => true,
                    'likes' => $comment->like
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطایی رخ داد: ' . $e->getMessage()
                ], 500);
            }
    }
    elseif($name == "dislike"){
       try {
            // پیدا کردن کامنت با استفاده از ID
            $comment = CommentProduct::find($id);

            // اگر کامنت یافت نشد، پیام خطا بده
            if (!$comment) {
                return response()->json([
                    'success' => false,
                    'message' => 'کامنت با این ID یافت نشد'
                ], 404);
            }

            // اگر مقدار like برابر با null بود، آن را به 0 تنظیم می‌کنیم
            if ($comment->like === null) {
                $comment->like = 0;
            }

            // افزایش مقدار like
            $comment->increment('dislike');

            return response()->json([
                'success' => true,
                'dislike' => $comment->dislike
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطایی رخ داد: ' . $e->getMessage()
            ], 500);
        }
    }

    }

    function store(Request $req , $id){

        $req->validate([
            'comment' => 'required|string|max:500',
        ]);
        $comment = new CommentProduct();
        $comment->comment  =  $req->comment;
        $comment->verify = 0;
        $comment->product_id = $id;
        $comment->save();
        return redirect()->back()->with('status', 'نظر شما ثبت شد. در صورت تایید مدیر، در این صفحه نمایش داده خواهد شد.');
    }
    }




