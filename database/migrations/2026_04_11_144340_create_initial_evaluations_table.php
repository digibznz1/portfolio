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
        Schema::create('initial_evaluations', function (Blueprint $table) {
            $table->id();
            
            $table->text('question')->nullable();
            $table->boolean('answer');
            
            $table->text('description')->nullable();

            $table->boolean('status')->default(1);
            $table->integer('index')->default(0);
            $table->index('index');

            $table->foreignIdFor(\App\Models\OrganizationType::class)->nullable();
            $table->foreignIdFor(\App\Models\Category::class)->nullable();
            $table->foreignIdFor(\App\Models\Admin::class);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initial_evaluations');
    }
};
