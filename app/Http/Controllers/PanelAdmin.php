<?php

namespace App\Http\Controllers;

use App\Models\categorymenu;
use App\Models\CategoryZirMenu;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PanelAdmin extends Controller
{

    public function checkadmin($req)
    {
        if ($req->is('*AdminPanel*')) {

            if (!session('user_role')) {
                return false;
            } else {
                if (Crypt::decrypt(session('user_role')) != 'admin') {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
    function index(Request $req)
    {

        if ($this->checkadmin($req) == false) {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        } else {
            $orders = Order::with('items')->get();
            $is_active = 1;
            $labels = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'];
$values = [100, 200, 150, 300, 250, 400];

            // dd($orders);
            return view('admin.PanelAdmin', compact('orders', 'is_active','labels','values'));
        }
    }







    function Categorys(Request $req)
    {

        if ($this->checkadmin($req)) {

            $Categorys = CategoryZirMenu::with(['categoryMenu'])->get();
            $Categoryfamily = categorymenu::all();
            // dd($Categorys);
            $is_active = 4;
            return view('admin.AdminCategory', compact('Categorys', 'is_active', 'Categoryfamily'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }

    function Categorys_adds(Request $req)
    {

        if ($this->checkadmin($req)) {
            if (isset($req['valedname'])) {
                $Categoryfamily = new categorymenu();

                $Categoryfamily->name = $req['valedname'];

                $Categoryfamily->active = 1;

                $Categoryfamily->save();
            } else {
                $Category = new CategoryZirMenu();

                $Category->name = $req['category'];

                $Category->active = 1;
                $Category->category_id = $req['valedid'];

                $Category->save();
            }

            $Categorys = CategoryZirMenu::with(['categoryMenu'])->get();
            $Categoryfamily = categorymenu::all();
            // dd($Categorys);
            $is_active = 4;
            return view('admin.AdminCategory', compact('Categorys', 'is_active', 'Categoryfamily'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }
    function Categorys_remove(Request $req, $id)
    {
        $Categorys = CategoryZirMenu::find($id);
        // dd($orders);
        $Categorys->delete();


        $Categorys = CategoryZirMenu::with(['categoryMenu'])->get();
        $Categoryfamily = categorymenu::all();
        // dd($Categorys);
        $is_active = 4;
        return redirect()->route('AdminPanel.Categorys');
    }
    function Categorys_status(Request $req, $id)
    {
        $Categorys = CategoryZirMenu::find($id);
        // dd($orders);

        if ($Categorys->active == 0) {
            $Categorys->active = 1;
        } else {
            $Categorys->active = 0;
        }
        $Categorys->save();

        $is_active = 4;
        return redirect()->route('AdminPanel.Categorys');
    }







    function Users(Request $req)
    {

        if ($this->checkadmin($req)) {

            $user = User::all();
            $admins = 0;
            $all = 1;
            $is_active = 3;
            return view('admin.AdminUsers', compact('user', 'admins', 'all', 'is_active'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }
    function Users_admins(Request $req)
    {

        if ($this->checkadmin($req)) {

            $user = User::where('isadmin', '1')->get();
            $admins = 1;
            $all = 0;
            $is_active = 3;
            return view('admin.AdminUsers', compact('user', 'admins', 'all', 'is_active'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }

    function Users_serech(Request $req)
    {
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

        return view('admin.AdminUsers', compact('user', 'admins', 'all'));
    }
    function Users_remove(Request $req, $id)
    {
        $user = User::find($id);
        // dd($orders);
        $user->delete();


        $user = User::all();

        $admins = 0;
        $all = 1;

        return view('admin.AdminUsers', compact('user', 'admins', 'all'));
    }
    function Users_status(Request $req, $id)
    {
        $user = User::find($id);

        if ($user->status == 0) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->save();


        $user = User::all();

        $admins = 0;
        $all = 1;

        return view('admin.AdminUsers', compact('user', 'admins', 'all'));
    }
    function Users_logaout(Request $req)
    {

        // پاک کردن سشن و خروج کاربر
        session()->invalidate();
        return  redirect()->route('Login.index');
    }







    function Products(Request $req)
    {

        if ($this->checkadmin($req)) {

            $Products = DB::select("
        SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
               s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
               s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
               s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
        FROM category_zir_menu u
        INNER JOIN products s ON s.category_id = u.id
    ");

            $stoke = 0;
            $notstoke = 0;
            $is_active = 2;
            return view('admin.AdminPrroducts', compact('Products', 'notstoke', 'stoke', 'is_active'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }
    function Products_remove(Request $req, $id)
    {
        $Products = Product::find($id);
        if ($Products) {
            $Products->forceDelete();
        }
        $Products = DB::select("
        SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
               s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
               s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
               s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
        FROM category_zir_menu u
        INNER JOIN products s ON s.category_id = u.id
    ");
        // dd($orders);
        $stoke = 0;
        $notstoke = 0;
        $is_active = 2;
        return redirect()->route('AdminPanel.Products')->with('Products', 'notstoke', 'stoke', 'is_active');
    }
    function Products_status(Request $req, $id)
    {
        $Products = Product::find($id);
        // dd($orders);
        if ($Products->status == "inactive") {
            $Products->status = "active";
        } else {
            $Products->status = "inactive";
        }
        $Products->save();
        $Products = DB::select("
      SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
             s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
             s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
             s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
      FROM category_zir_menu u
      INNER JOIN products s ON s.category_id = u.id
  ");
        // dd($orders);
        $stoke = 0;
        $notstoke = 0;
        $is_active = 2;
        return redirect()->route('AdminPanel.Products')->with('Products', 'notstoke', 'stoke', 'is_active');
    }

    function Products_fe(Request $req, $id)
    {
        $Products = Product::find($id);
        // dd($orders);
        if ($Products->is_featured == 1) {
            $Products->is_featured = 0;
        } else {
            $Products->is_featured = 1;
        }
        $Products->save();

        $Products = DB::select("
      SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
             s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
             s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
             s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
      FROM category_zir_menu u
      INNER JOIN products s ON s.category_id = u.id
  ");
        // dd($orders);
        $stoke = 0;
        $notstoke = 0;
        $is_active = 2;
        return redirect()->route('AdminPanel.Products')->with('Products', 'notstoke', 'stoke', 'is_active');
    }


    function Products_stoke(Request $req)
    {

        if ($this->checkadmin($req)) {

            $Products = DB::select("
            SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
                   s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
                   s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
                   s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
            FROM category_zir_menu u
            INNER JOIN products s ON s.category_id = u.id where s.stock > 0
        ");
            $stoke = 1;
            $notstoke = 0;
            $is_active = 2;
            return view('admin.AdminPrroducts', compact('Products', 'notstoke', 'stoke', 'is_active'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }

    function Products_notstoke(Request $req)
    {

        if ($this->checkadmin($req)) {

            $Products = DB::select("
                SELECT u.id, u.category_id, u.name, u.img, u.active, u.position, u.deleted_at, u.created_at, u.updated_at,
                       s.id as product_id, s.name as product_name, s.description, s.price, s.discount, s.final_price,
                       s.sku, s.category_id, s.stock, s.sold, s.view, s.image, s.status, s.is_featured,
                       s.created_at as product_created_at, s.updated_at as product_updated_at, s.deleted_at as product_deleted_at
                FROM category_zir_menu u
                INNER JOIN products s ON s.category_id = u.id where s.stock <= 0
            ");
            $stoke = 0;
            $notstoke = 1;
            $is_active = 2;
            return view('admin.AdminPrroducts', compact('Products', 'notstoke', 'stoke', 'is_active'));
        } else {
            return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
        }
    }
    function Products_serech(Request $req)
    {
        $query = DB::table('category_zir_menu as u')
        ->join('products as s', 's.category_id', '=', 'u.id')
        ->select(
            'u.id', 'u.category_id', 'u.name', 'u.img', 'u.active', 'u.position', 'u.deleted_at', 'u.created_at', 'u.updated_at',
            's.id as product_id', 's.name as product_name', 's.description', 's.price', 's.discount', 's.final_price',
            's.sku', 's.category_id', 's.stock', 's.sold', 's.view', 's.image', 's.status', 's.is_featured',
            's.created_at as product_created_at', 's.updated_at as product_updated_at', 's.deleted_at as product_deleted_at'
        ); // فقط محصولات ناموجود را نمایش بده

    // **افزودن فیلترهای اختیاری:**
    if (!empty($req->name)) {
        $query->where('s.name', 'Like', "%{$req->name}%");
    }

    if (!empty($req->price)) {
        $query->where('s.price', 'Like', "%{$req->price}%");
    }
    if (!empty($req->cat)) {
        $query->where('u.name', 'Like', "%{$req->cat}%");
    }

    // **اجرای کوئری و دریافت نتیجه**
    $Products = $query->get();


    $stoke = 0;
    $notstoke = 0;
    $is_active = 2;
    return view('admin.AdminPrroducts', compact('Products', 'notstoke', 'stoke', 'is_active'));
    }








    function OrderRemove(Request $req, $id)
    {
        if ($this->checkadmin($req)) {
        $orders = Order::find($id);
        // dd($orders);
        $orders->delete();
        $orders = Order::with('items')->get();
        // dd($orders);
        return view('admin.PanelAdmin', compact('orders'));
    } else {
        return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
    }
    }

    function OrderEdit(Request $req, $id,$status)
    {
        if ($this->checkadmin($req)) {
        $orders = Order::find($id);
        $orderitem = Order::with(['items'])->find($id);



            if($status == 2){
                foreach ($orderitem->items as $item) {
                $Products = Product::find($item->product_id);
                $Products->sold =  $Products->sold + $item->quantity;
                $Products->save();
            }

            }
            elseif($status == -1 && $orders->status >=2){
                foreach ($orderitem->items as $item) {
                    $Products = Product::find($item->product_id);
                    $Products->sold =  $Products->sold - $item->quantity;
                    $Products->save();
                }
            }

            $orders->status = $status;

        // dd($orders);






        $orders->save();
        $orders = Order::with('items')->get();
        // dd($orders);
        return view('admin.PanelAdmin', compact('orders'));
    } else {
        return redirect()->route('Login.index')->with('error', 'لطفاً وارد شوید');
    }

    }
}
