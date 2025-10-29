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
<<<<<<<< HEAD:database/migrations/2025_10_09_041443_create_canteens_table.php
        Schema::create('canteens', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    
            $table->text('description');      
            $table->string('image')->nullable();
            $table->timestamps();
========
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
>>>>>>>> origin/main:database/migrations/2025_10_08_234001_remove_description_from_products_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_10_09_041443_create_canteens_table.php
        Schema::dropIfExists('canteens');
========
        Schema::table('products', function (Blueprint $table) {
            //
        });
>>>>>>>> origin/main:database/migrations/2025_10_08_234001_remove_description_from_products_table.php
    }
};
