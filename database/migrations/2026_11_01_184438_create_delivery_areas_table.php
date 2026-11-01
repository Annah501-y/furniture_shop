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
        Schema::create('delivery_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('region', 150)->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->unsignedInteger('estimated_days')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_areas');
    }
};
