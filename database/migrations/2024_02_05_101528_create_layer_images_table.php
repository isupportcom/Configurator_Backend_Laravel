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
        Schema::create('layer_images', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(false);
            $table->unsignedBigInteger('layer_id');
            $table->timestamps();

            $table->foreign('layer_id')->references('id')->on('final_product_layers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layer_images');
    }
};
