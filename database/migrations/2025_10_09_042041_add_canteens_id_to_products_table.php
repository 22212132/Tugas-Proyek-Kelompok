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
        Schema::table('products', function (Blueprint $table) {
        $table->unsignedBigInteger('canteen_id')->after('id');

        $table->foreign('canteen_id')
              ->references('id')
              ->on('canteens')
              ->onDelete('cascade'); // hapus produk jika kantinnya dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['canteen_id']);
        $table->dropColumn('canteen_id');
        });
    }
};
