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
        Schema::create('self_evaluations', function (Blueprint $table) {
            $table->id();

            $table->text('name')->nullable();
            $table->enum('alert_type', App\Admin\SelfEvaluation\AlertTypeEnums::values())->default(App\Admin\SelfEvaluation\AlertTypeEnums::TEXT->value);
            $table->text('alert_value')->nullable();
            $table->text('alert')->nullable();
            $table->text('explain')->nullable();
            $table->string('degree')->nullable();

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
        Schema::dropIfExists('self_evaluations');
    }
};
