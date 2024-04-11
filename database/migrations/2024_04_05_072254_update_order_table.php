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
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('order_name');

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
