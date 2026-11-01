
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Category relationship
            $table->foreignId('category_id')
                ->constrained('categories');

            // Basic product information
            $table->string('name', 255);
            $table->string('slug', 280)->unique();
            $table->string('sku', 60)->unique();
            $table->text('description')->nullable();

            // Pricing
            $table->decimal('price', 12, 2);
            $table->decimal('compare_at_price', 12, 2)->nullable();

            // Furniture specifications
            $table->string('material', 150)->nullable();
            $table->decimal('width_cm', 8, 2)->nullable();
            $table->decimal('height_cm', 8, 2)->nullable();
            $table->decimal('depth_cm', 8, 2)->nullable();
            $table->decimal('weight_kg', 8, 2)->nullable();

            // Inventory
            $table->unsignedInteger('stock_quantity')->default(0);

            // Product visibility
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // Soft deletion
            $table->softDeletes();

            $table->timestamps();

            // Indexes
            $table->index('category_id');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
