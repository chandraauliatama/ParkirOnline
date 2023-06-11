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
        Schema::create('parking_points', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_occupied')->default(false);
            $table->string('plat_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_points');
    }
};
