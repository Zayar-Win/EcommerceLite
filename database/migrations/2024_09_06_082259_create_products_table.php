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
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->string('price')->default('1000');
            $table->text('description')->nullable();
            $table->decimal('discount', 8, 2)->nullable();
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
