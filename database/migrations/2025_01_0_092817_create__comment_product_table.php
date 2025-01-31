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
        Schema::create('comment_product', function (Blueprint $table) {
            $table->id();
            //یوز هم اضافه بشود
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('products') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->string('comment');
            $table->boolean('verify')->default(0);
            $table->bigInteger('like')->default(0);
            $table->bigInteger('dislike')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_product');
    }
};
