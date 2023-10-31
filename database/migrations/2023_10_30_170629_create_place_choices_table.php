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
        Schema::create('place_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_place_id');
            $table->string('name', 255);
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('card_place_id')->references('id')->on('cards_places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_choices');
    }
};
