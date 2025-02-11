<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function checkuser($req)
    {
        if ($req->is('*cart*')) {

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
    // افزودن محصول به سبد خرید
    public function addToCart(Request $request,$id)
    {
        if($this->checkuser($request) == true){
            $product = Product::findOrFail($id); // پیدا کردن محصول
            $quantity = $request->input('quantity', 1); // دریافت تعداد از فرم

            // گرفتن سبد خرید از session
            $cart = session()->get('cart', []);

            // بررسی تعداد محصول موجود در سبد خرید
            $existingProduct = isset($cart[$id]) ? $cart[$id] : null;

            // جمع تعداد محصول موجود در سبد خرید
            $totalQuantityInCart = $existingProduct ? $existingProduct['quantity'] : 0;

            // بررسی اینکه مجموع تعداد وارد شده و تعداد موجود در سبد خرید بیشتر از موجودی نباشد
            if (($totalQuantityInCart + $quantity) > $product->stock) {
                return redirect()->back()->with('error', 'تعداد وارد شده بیشتر از موجودی است!');
            }

            // اگر محصول قبلاً در سبد خرید باشد، تعداد آن را افزایش می‌دهیم
            if ($existingProduct) {
                $cart[$id]['quantity'] += $quantity; // افزایش تعداد
            } else {
                // در غیر این صورت، محصول جدید را به سبد خرید اضافه می‌کنیم
                $cart[$id] = [
                    'name' => $product->name,
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
            }

            // ذخیره کردن سبد خرید در Session
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'محصول به سبد خرید اضافه شد!');
        }
        else{
            return redirect()->route('Login.index');
        }

    }

    // مشاهده سبد خرید
    public function viewCart(Request $request)
    {        if($this->checkuser($request) == true){

        return view('cart');
    }
    else{
        return redirect()->route('Login.index');
    }
    }

    // حذف محصول از سبد خرید
    public function removeFromCart(Request $request, $id )
    {
        if($this->checkuser($request) == true){
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'محصول از سبد خرید حذف شد!');
    }
    else{
        return redirect()->route('Login.index');
    }
    }

    public function updateCart(Request $request)
{
    if($this->checkuser($request) == true){
    $cart = session()->get('cart', []);
    $quantity = $request->input('quantity', []);

    foreach ($quantity as $id => $qty) {
        // بررسی اینکه تعداد وارد شده از موجودی بیشتر نباشد
        $product = Product::findOrFail($id);

        if ($qty > $product->stock) {
            return redirect()->back()->with('error', 'تعداد وارد شده بیشتر از موجودی محصول است.');
        }

        // بروزرسانی تعداد محصول در سبد خرید
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
        }
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'سبد خرید شما بروزرسانی شد!');
}
else{
    return redirect()->route('Login.index');
}
}

function submitCart(Request $request){
    if($this->checkuser($request) == true){

      $uid =   Crypt::decrypt(session('user_id'));

    $cart = session()->get('cart', []);
    // dd($cart);
// dd($request->total);
$request->validate([
    'name' => 'required|string',
    'phone' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
    'address' => 'required|string',
    'delivery' => 'required|in:post,express',
    'payment' => 'required|in:online,cash',
]);


$totalPrice = $request->total;

$order = new Order();
$order->user_id = $uid;
$order->name = $request->name;
$order->phone = $request->phone;
$order->address = $request->address;
$order->delivery = $request->delivery;
$order->payment = $request->payment;
$order->total_price = $totalPrice;


$order->save();

foreach ( $cart as $item) {

    $order->items()->create([
        'product_id' => $item['id'],
        'price' => $item['price'],
        'quantity' => $item['quantity']
    ]);
}
$oid = $order->id;

foreach ($cart as $item){
    unset($cart[$item['id']]);

    $product = Product::find($item['id']);
    $product->stock =  $product->stock - $item['quantity'];
    $product->save();

}


            session()->put('cart', $cart);

// return response()->json(['message' => 'سفارش با موفقیت ثبت شد!', 'order_id' => $order->id], 201);
        return view('cart',compact('oid'));
    }
    else{
        return redirect()->route('Login.index');
    }

}

}
