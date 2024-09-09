<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->text('shipping_address')->nullable();
            $table->text('notes')->nullable();
            $table->text('screenshort')->nullable();
            $table->string('shipping_recipient_name')->nullable();
            $table->string('shipping_ph_number')->nullable();
            $table->date('delivery_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
