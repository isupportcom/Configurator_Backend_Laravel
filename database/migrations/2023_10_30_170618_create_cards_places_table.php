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
        Schema::create('cards_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_card_id');
            $table->string('name', 255);
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('product_card_id')->references('id')->on('products_cards')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards_places');
    }
};
