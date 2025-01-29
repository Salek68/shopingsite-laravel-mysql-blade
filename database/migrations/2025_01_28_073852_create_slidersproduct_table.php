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
        Schema::create('slidersproduct', function (Blueprint $table) {
            $table->id(); // شناسه اصلی جدول
            $table->string('position'); // موقعیت محصول (مثلاً "ویژه"، "تخفیف‌دار"، "پرفروش")
            $table->boolean('status')->default(1); // وضعیت فعال یا غیرفعال بودن محصول
            $table->unsignedBigInteger('zir_menu_id'); // کلید خارجی مرتبط با زیرمنوها
            $table->foreign('zir_menu_id') // تنظیم رابطه
                ->references('id') // اشاره به ستون id
                ->on('category_zir_menu') // نام جدول زیرمنوها
                ->onDelete('cascade'); // حذف cascading
            $table->timestamps(); // زمان‌بندی
            $table->softDeletes(); // حذف نرم

             // تعریف ترکیب یونیک برای وضعیت و موقعیت
            $table->unique(['position', 'status'], 'unique_position_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slidersproduct');
    }
};
