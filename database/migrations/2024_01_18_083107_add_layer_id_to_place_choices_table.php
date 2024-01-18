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
        if (!Schema::hasColumn('place_choices', 'layer_id')) {
            Schema::table('place_choices', function (Blueprint $table) {
                $table->unsignedBigInteger('layer_id')->nullable()->after('name');
                $table->foreign('layer_id')->references('id')->on('final_product_layers'); // Adjust the table name if needed
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('place_choices', 'layer_id')) {
            Schema::table('place_choices', function (Blueprint $table) {
                $table->dropForeign(['layer_id']);
                $table->dropColumn('layer_id');
            });
        }
    }
};
