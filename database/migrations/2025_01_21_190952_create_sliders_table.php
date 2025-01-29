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
        Schema::create('sliders', function (Blueprint $table) {

                $table->id(); // کلید اصلی جدول
                $table->string('position'); // موقعیت محصول (مثلاً "ویژه"، "تخفیف‌دار"، "پرفروش")
                $table->boolean('status')->default(1); // وضعیت فعال یا غیرفعال بودن محصول
                $table->unsignedBigInteger('productid'); // کلید خارجی مرتبط با محصولات
                $table->foreign('productid')->references('id')->on('products')->onDelete('cascade'); // تنظیم رابطه و حذف cascading
                $table->timestamps(); // زمان‌های ایجاد و ویرایش
                $table->softDeletes(); // حذف نرم‌افزاری
          

        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
