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

        Schema::create('vigeiha', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('category_zir_menu') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vigeiproduct', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('products') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->unsignedBigInteger("vigei_id");
            $table->foreign('vigei_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('vigeiha') // نام جدول زیرمنوها
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
        Schema::dropIfExists('vigeiproduct');
    }
};
