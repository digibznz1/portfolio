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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('flag')->default('flag.png');
            $table->string('code')->unique();
            $table->json('permission')->nullable();

            $table->enum('dir', ['RTL', 'LTR']);

            $table->boolean('default')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('index')->default(0);
            $table->index('index');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
