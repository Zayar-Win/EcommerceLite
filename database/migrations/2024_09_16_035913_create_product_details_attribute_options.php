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
        Schema::create('product_details_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productDetail_id');
            $table->unsignedBigInteger('attributeOption_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details_attribute_options');
    }
};
