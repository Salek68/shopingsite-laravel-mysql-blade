<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
    $table->string('name'); // نام مشتری
    $table->string('phone'); // شماره تماس
    $table->text('address'); // آدرس مشتری
    $table->enum('delivery', ['post', 'express']); // روش ارسال
    $table->enum('payment', ['online', 'cash']); // روش پرداخت
    $table->bigInteger('total_price'); // مجموع قیمت
    $table->boolean('status')->default(0);
    $table->timestamps();
    $table->softDeletes();
        });


        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('orders') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('products') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->bigInteger('price'); // قیمت محصول
            $table->integer('quantity'); // تعداد محصول
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
