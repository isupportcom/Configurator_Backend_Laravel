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
        if (!Schema::hasColumn('layer_images', 'card_place_id')) {
            Schema::table('layer_images', function (Blueprint $table) {
                $table->unsignedBigInteger('card_place_id')->nullable()->after('layer_id');
                $table->foreign('card_place_id')->references('id')->on('cards_places'); // Adjust the table name if needed
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       if (Schema::hasColumn('layer_images', 'card_place_id')) {
            Schema::table('layer_images', function (Blueprint $table) {
                $table->dropForeign(['card_place_id']);
                $table->dropColumn('card_place_id');
            });
        }
    }
};
