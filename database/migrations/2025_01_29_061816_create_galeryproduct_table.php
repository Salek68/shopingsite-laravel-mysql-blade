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
        Schema::create('galeryproduct', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('products') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeryproduct');
    }
};
