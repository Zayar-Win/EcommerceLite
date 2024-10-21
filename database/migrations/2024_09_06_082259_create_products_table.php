<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('product_detail_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_detail_id')->nullable();;
            // $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->integer('priority')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
