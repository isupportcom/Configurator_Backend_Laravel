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
        Schema::create('layers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('final_product_layer_id')->unsigned();


            $table->foreign('final_product_layer_id')->references('id')->on('final_product_layers')->onDelete('cascade');
            $table->uuid('unique_layer_id')->unique();
            $table->timestamps();
        });
        
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layers');
    }
};
