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
        Schema::table('shipping_address', function (Blueprint $table) {
            $table->string('billing_name');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zip');
            $table->string('billing_mobile');
            $table->string('billing_nearby');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
