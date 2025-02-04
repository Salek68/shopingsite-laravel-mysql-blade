<?php

use App\Http\Controllers\landing;
use App\Http\Controllers\category;
use App\Http\Controllers\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanelAdmin;
use App\Http\Controllers\RegisterController;

Route::get('/',[landing::class,'index'])->name('index');

Route::get('/category/{name}',[category::class,'MenuList'])->name('category');

Route::get('/Product/{id}',[Products::class,'index'])->name('singelproduct');
Route::post('/Product/{id}/{name}',[Products::class,'update'])->name('updatenazar');
Route::post('/Product/{id}',[Products::class,'store'])->name('storecomment');





Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/submit', [CartController::class, 'submitCart'])->name('cart.submit');

Route::get('/Register',[RegisterController::class,'index'])->name('Register.index');
Route::get('/Login',[LoginController::class,'index'])->name('Login.index');
Route::post('/Login',[LoginController::class,'index1'])->name('Login.index1');



Route::get('/AdminPanel',[PanelAdmin::class,'index'])->name('AdminPanel.index');
Route::get('/AdminPanel/Orders/Remove/{id}',[PanelAdmin::class,'OrderRemove'])->name('AdminPanel.Orders.Remove');
Route::get('/AdminPanel/Orders/Edit/{id}',[PanelAdmin::class,'OrderEdit'])->name('AdminPanel.Orders.Edit');
