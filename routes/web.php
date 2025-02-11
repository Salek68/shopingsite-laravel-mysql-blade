<?php

use App\Http\Controllers\landing;
use App\Http\Controllers\category;
use App\Http\Controllers\Products;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\PanelAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPanel;

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
Route::post('/Register/save',[RegisterController::class,'save'])->name('Register.Register');

Route::get('/Login',[LoginController::class,'index'])->name('Login.index');
Route::post('/Login',[LoginController::class,'index1'])->name('Login.check');


Route::get('/UserPanel',[UserPanel::class,'index'])->name('UserPanel.index');
Route::get('/UserPanel/Orders/remove/{id}',[UserPanel::class,'Orders_remove'])->name('UserPanel.Orders_remove');




Route::get('/AdminPanel',[PanelAdmin::class,'index'])->name('AdminPanel.index');

Route::get('/AdminPanel/Users',[PanelAdmin::class,'Users'])->name('AdminPanel.Users');
Route::get('/AdminPanel/Users/Users_logaout',[PanelAdmin::class,'Users_logaout'])->name('AdminPanel.Users_logaout');
Route::post('/AdminPanel/Users/serech',[PanelAdmin::class,'Users_serech'])->name('AdminPanel.Users_serech');
Route::get('/AdminPanel/Users/remove/{id}',[PanelAdmin::class,'Users_remove'])->name('AdminPanel.Users_remove');
Route::get('/AdminPanel/Users/status/{id}',[PanelAdmin::class,'Users_status'])->name('AdminPanel.Users_status');
Route::get('/AdminPanel/Users/admins',[PanelAdmin::class,'Users_admins'])->name('AdminPanel.Users.admins');

Route::get('/AdminPanel/Products',[PanelAdmin::class,'Products'])->name('AdminPanel.Products');
Route::post('/AdminPanel/Products/serech',[PanelAdmin::class,'Products_serech'])->name('AdminPanel.Products_serech');
Route::get('/AdminPanel/Products/remove/{id}',[PanelAdmin::class,'Products_remove'])->name('AdminPanel.Products_remove');
Route::get('/AdminPanel/Products/status/{id}',[PanelAdmin::class,'Products_status'])->name('AdminPanel.Products_status');
Route::get('/AdminPanel/Products/fe/{id}',[PanelAdmin::class,'Products_fe'])->name('AdminPanel.Products_fe');
Route::get('/AdminPanel/Products/stoke',[PanelAdmin::class,'Products_stoke'])->name('AdminPanel.Products_stoke');
Route::get('/AdminPanel/Products/notstoke',[PanelAdmin::class,'Products_notstoke'])->name('AdminPanel.Products_notstoke');

Route::get('/AdminPanel/Orders/Remove/{id}',[PanelAdmin::class,'OrderRemove'])->name('AdminPanel.Orders.Remove');
Route::get('/AdminPanel/Orders/Edit/{id}',[PanelAdmin::class,'OrderEdit'])->name('AdminPanel.Orders.Edit');



Route::get('/AdminPanel/Categorys',[PanelAdmin::class,'Categorys'])->name('AdminPanel.Categorys');
Route::get('/AdminPanel/Categorys/remove/{id}',[PanelAdmin::class,'Categorys_remove'])->name('AdminPanel.Categorys_remove');
Route::get('/AdminPanel/Categorys/status/{id}',[PanelAdmin::class,'Categorys_status'])->name('AdminPanel.Categorys_status');
Route::post('/AdminPanel/Categorys/adds',[PanelAdmin::class,'Categorys_adds'])->name('AdminPanel.Categorys_adds');
