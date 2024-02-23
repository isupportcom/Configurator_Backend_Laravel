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
        Schema::create('default_selections', function (Blueprint $table) {
         
            $table->id();
            $table->string('mainSelected'); // Storing an array of integers as a JSON column
            $table->json('subSelected');
            $table->unsignedBigInteger('finalProductId');
            $table->timestamps();

            // You may need to add a foreign key constraint for unique_layer_id if it references another table
            $table->foreign('finalProductId')->references('id')->on('final_products');
      
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_selections');
    }
};
