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
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('order_name');
            $table->string('order_address');
            $table->string('order_city');
            $table->string('order_state');
            $table->string('order_zip');
            $table->string('order_mobile');
            $table->string('order_nearby');
            $table->string('paymentmode');
            $table->string('product_quantity');
            $table->string('product_price');
            $table->string('order_status');
            $table->string('card_name');
            $table->string('card_number');
            $table->string('card_cvv');
            $table->string('card_month');
            $table->string('card_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
