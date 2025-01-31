<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\slider;
use App\Models\Product;
use App\Models\categorymenu;
use Illuminate\Http\Request;
use App\Models\SliderProduct;
use App\Models\CategoryZirMenu;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class landing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(request()->is('*')){
            $categorymenu1 = CategoryMenu::with('submenus')->where('id', '>', 0)->where('active', '=', 1)->where('position', '=', "menu1")->get();
// dd($categorymenu1);
            view()->share('menu1', $categorymenu1);
        }
        if(request()->is('/')){

            $slider1 = slider::where('status', 1)
            ->where('position', 'slider1')
            ->with('product:id,name,description,price,discount,image') // بارگذاری محصول مرتبط
            ->get()
            ->map(function ($slider) {
                return [
                    'name' => $slider->product->name ?? null,
                    'id' => $slider->product->id ?? null,
                    'description' => $slider->product->description ?? null,
                    'price' => $slider->product->price ?? null,
                    'discount' => $slider->product->discount ?? null,
                    'image' => $slider->product->image ?? null,
                ];
            });
            view()->share('slider1', $slider1);

            $featuredProduct = Product::where('is_featured', 1) // فیلتر کردن محصولاتی که featured هستند
                           ->orderBy('updated_at', 'DESC') // ترتیب صعودی بر اساس تاریخ ایجاد
                           ->first(); // فقط اولین نتیجه را می‌خواهیم
           view()->share('featuredProduct', $featuredProduct);

           $results = DB::table('slidersproduct')
           ->select(
               'slidersproduct.position',
               'category_zir_menu.name as zir_menu_name',
               'category_menu.name as category_name',
               'products.id as product_id',
               'products.name as product_name',
               'products.price as product_price',
               'products.description as product_description',
               'products.image as image'
           )
           ->leftJoin('category_zir_menu', 'slidersproduct.zir_menu_id', '=', 'category_zir_menu.id')
           ->leftJoin('category_menu', 'category_zir_menu.category_id', '=', 'category_menu.id')
           ->leftJoin('products', 'products.category_id', '=', 'category_zir_menu.id')
           ->where('slidersproduct.status', 1)
           ->groupBy(
               'slidersproduct.position',
               'category_zir_menu.name',
               'category_menu.name',
               'products.id',
               'products.name',
               'products.price',
               'products.description',
               'products.image'
           )
           ->orderBy('slidersproduct.position', 'asc')
           ->get();
           view()->share('results', $results);

//     SELECT `baner_category`.`position`, `category_zir_menu`.`name`, `category_zir_menu`.`img`
// FROM `baner_category`
// LEFT JOIN `category_zir_menu` ON `baner_category`.`category_id` = `category_zir_menu`.`id`
// where baner_category.status = 1 ;


$baners = DB::table('baner_category')
->select(
    'baner_category.position',
    'category_zir_menu.name',
    'category_zir_menu.img as image'

)
->leftJoin('category_zir_menu', 'baner_category.category_id', '=', 'category_zir_menu.id')
->where('baner_category.status', 1)
->get();
view()->share('baners', $baners);

$upview = Product::orderBy('products.view','DESC')->limit('3')->get();

view()->share('upview', $upview);


    }

    return $next($request);
}
}
