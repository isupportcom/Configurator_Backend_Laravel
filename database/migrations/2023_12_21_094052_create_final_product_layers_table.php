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
        Schema::create('final_product_layers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('final_product_id');
            $table->integer('layers')->nullable(false)->default(1);
            $table->timestamps();

            $table->foreign('final_product_id')->references('id')->on('final_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_product_layers');
    }
};
