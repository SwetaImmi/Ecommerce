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
        // Schema::table('order', function (Blueprint $table) {
        //     $table->unsignedBigInteger('address_id')->nullable();
        //     $table->foreign('address_id')->references('id')->on('shipping_address')->onDelete('SET NULL');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            // $table->dropColumn('order_address');
            // $table->dropColumn('order_city');
            // $table->dropColumn('order_state');
            // $table->dropColumn('order_city');
            $table->dropColumn('order_zip');
            $table->dropColumn('order_mobile');
            $table->dropColumn('order_nearby');
        });
    }
};
