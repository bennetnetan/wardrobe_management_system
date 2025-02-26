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
        Schema::table('clothing', function (Blueprint $table) {
            $table->string('category')->after('description')->nullable(); // Add the `category` column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clothing', function (Blueprint $table) {
            $table->dropColumn('category'); // Remove the `category` column if rolling back
        });
    }
};