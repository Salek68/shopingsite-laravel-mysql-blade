<?php

use App\Http\Controllers\category;
use App\Http\Controllers\landing;
use App\Http\Controllers\Products;
use Illuminate\Support\Facades\Route;

Route::get('/',[landing::class,'index']);
Route::get('/category/{name}',[category::class,'MenuList'])->name('category');
Route::get('/Product/{id}',[Products::class,'index'])->name('singelproduct');
