<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products_card', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('final_product_id');
            $table->string('name', 255);
            $table->string('icon', 255);
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('final_product_id')->references('id')->on('final_product')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_cards');
    }
};
