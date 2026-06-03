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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('subtitle')->nullable();
            $table->string('price')->nullable();
            $table->json('price_unit')->nullable();
            $table->json('features')->nullable();
            $table->json('button_text')->nullable();
            $table->enum('button_style', ['outline', 'filled'])->default('outline');
            $table->boolean('is_featured')->default(false);
            $table->unsignedTinyInteger('index')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
