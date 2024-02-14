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
        if (!Schema::hasColumn('layer_images', 'unique_layer_id')) {
            Schema::table('layer_images', function (Blueprint $table) {
                $table->unsignedBigInteger('unique_layer_id')->nullable()->after('layer_id');
                $table->foreign('unique_layer_id')->references('id')->on('layers'); // Adjust the table name if needed
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('layer_images', 'unique_layer_id')) {
            Schema::table('layer_images', function (Blueprint $table) {
                $table->dropForeign(['unique_layer_id']);
                $table->dropColumn('unique_layer_id');
            });
        }
    }
};
