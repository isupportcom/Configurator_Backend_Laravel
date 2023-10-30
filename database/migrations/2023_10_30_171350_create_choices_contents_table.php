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
        Schema::create('choices_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_choice_id');
            $table->string('image', 255);
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('place_choice_id')->references('id')->on('place_choices')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices_contents');
    }
};
