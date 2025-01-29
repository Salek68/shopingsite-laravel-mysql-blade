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
        Schema::create('baner_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id') // تنظیم رابطه
            ->references('id') // اشاره به ستون id
            ->on('category_zir_menu') // نام جدول زیرمنوها
            ->onDelete('cascade');
            $table->string('position');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['position', 'status'], 'unique_position_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baner_category');
    }
};
