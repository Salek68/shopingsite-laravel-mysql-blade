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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('pos');
            $table->string('i');
            $table->string('route');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default('1');
            $table->boolean('isadmin')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('AdminPos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_id");
            $table->foreign('admin_id') // تنظیم رابطه
                ->references('id') // اشاره به ستون id
                ->on('users') // نام جدول زیرمنوها
                ->onDelete('cascade');

                $table->unsignedBigInteger("pos_id");
                $table->foreign('pos_id') // تنظیم رابطه
                    ->references('id') // اشاره به ستون id
                    ->on('positions') // نام جدول زیرمنوها
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
