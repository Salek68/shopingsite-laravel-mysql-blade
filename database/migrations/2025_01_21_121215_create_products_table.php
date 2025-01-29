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
        Schema::create('products', function (Blueprint $table) {
    $table->id();  // شناسه منحصر به فرد برای هر محصول
    $table->string('name');  // نام محصول
    $table->text('description')->nullable();  // توضیحات محصول
    $table->bigInteger('price');  // قیمت محصول
    $table->decimal('discount', 5, 2)->default(0);  // تخفیف محصول (درصد)
    $table->decimal('final_price', 10, 2)->nullable();  // قیمت نهایی پس از تخفیف (اختیاری)
    $table->string('sku')->unique();  // کد محصول (شناسه منحصر به فرد)
    $table->foreignId('category_id')->constrained('category_zir_menu')->onDelete('cascade');  // ارتباط با دسته‌بندی محصول
    $table->integer('stock')->default(0);  // موجودی محصول
    $table->integer('sold')->default(0);
    $table->integer('view')->default(0);  // تعداد بازدید  محصول
    $table->string('image')->nullable();  // مسیر تصویر محصول
    $table->enum('status', ['active', 'inactive'])->default('active');  // وضعیت محصول (فعال/غیرفعال)
    $table->boolean('is_featured')->default(false);  // آیا محصول ویژه است؟
    $table->timestamps();  // زمان‌های ایجاد و بروزرسانی محصول
    $table->softDeletes();  // امکان حذف نرم محصول
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
