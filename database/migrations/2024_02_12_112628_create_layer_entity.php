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
        Schema::create('layer_entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('cat_cons'); // Storing an array of integers as a JSON column
            $table->unsignedBigInteger('unique_layer_id');
            $table->string('image');
            $table->timestamps();

            // You may need to add a foreign key constraint for unique_layer_id if it references another table
            $table->foreign('unique_layer_id')->references('id')->on('layers');

            // If place_choices is a table that cat_cons reference, you might need to create a pivot table instead
            // because cat_cons is an array and can't directly reference another table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layer_entities');
    }
};
