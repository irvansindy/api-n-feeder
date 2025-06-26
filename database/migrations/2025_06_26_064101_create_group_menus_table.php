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
        Schema::create('group_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // contoh: "Dashboard", "Master Data"
            $table->string('icon')->nullable(); // optional: icon untuk sidebar mini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_menus');
    }
};
