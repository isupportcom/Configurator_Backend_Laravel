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
        Schema::create('images_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(false);
            $table->unsignedBigInteger('final_product_layers_id');
            $table->timestamps();

            $table->foreign('final_product_layers_id')->references('id')->on('final_product_layers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_outputs');
    }
};
