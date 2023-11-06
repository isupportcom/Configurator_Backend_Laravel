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
        Schema::create('rulescnds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idr');
            $table->boolean('re');
            $table->integer('sosourcer');
            $table->integer('idc');
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('idr')->references('id')->on('rules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulescnds');
    }
};
