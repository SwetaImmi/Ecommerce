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
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->string('main_banner_content');
            $table->string('main_banner_image');
            $table->string('first_banner_content');
            $table->string('first_banner_image');
            $table->string('second_banner_content');
            $table->string('second_banner_image');
            $table->string('third_banner_content');
            $table->string('third_banner_image');
            $table->string('last_banner_content');
            $table->string('last_banner_image');
            $table->string('status');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner');
    }
};
