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
        Schema::create('category_menu', function (Blueprint $table) {
            $table->id();  // ایجاد فیلد id
            $table->string('name');
            $table->string('img')->default(null);
            $table->boolean('active');
            $table->string('position')->default("menu1");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_zir_menu', function (Blueprint $table) {
            $table->id();  // ایجاد فیلد id
            // افزودن فیلد category_id به جدول category_zir که به فیلد id در جدول category مربوط می‌شود
            $table->foreignId('category_id')->constrained('category_menu')->onDelete('cascade');
            $table->string('name');
            $table->string('img');
            $table->boolean('active');
            $table->string('position')->default("menu1");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_menu');
        Schema::dropIfExists('category_zir_menu');
    }
};
