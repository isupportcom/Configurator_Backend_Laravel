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
        Schema::create('image-config', function (Blueprint $table) {
         
                $table->id();
                $table->string('width'); // Storing an array of integers as a JSON column
                $table->string('height');
                $table->string('opacity');
                $table->unsignedBigInteger('layer_id');
                $table->string('posX');
                $table->string('posY');
                $table->string('posZ');
                $table->timestamps();
    
                // You may need to add a foreign key constraint for unique_layer_id if it references another table
                $table->foreign('layer_id')->references('id')->on('layers');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image-config');
    }
};
