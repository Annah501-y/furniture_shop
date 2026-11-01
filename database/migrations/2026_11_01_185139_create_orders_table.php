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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        // Order identification
        $table->string('order_number')->unique();

        // Customer information (guest checkout)
        $table->string('customer_name', 150);
        $table->string('customer_phone', 30);
        $table->string('customer_email')->nullable();

        // Delivery information
        $table->foreignId('delivery_area_id')
            ->constrained('delivery_areas');

        $table->text('delivery_address');
        $table->text('notes')->nullable();

        // Order totals
        $table->decimal('subtotal', 12, 2);
        $table->decimal('delivery_fee', 10, 2)->default(0);
        $table->decimal('total', 12, 2);

        // Order and payment status
        $table->enum('status', [
            'pending',
            'confirmed',
            'out_for_delivery',
            'delivered',
            'cancelled',
        ])->default('pending');

        $table->enum('payment_status', [
            'unpaid',
            'paid_on_delivery',
            'cancelled',
        ])->default('unpaid');

        $table->string('payment_method')
            ->default('pay_on_delivery');

        // Administrative information
        $table->text('admin_notes')->nullable();
        $table->text('cancel_reason')->nullable();

        // Order timestamps
        $table->timestamp('confirmed_at')->nullable();
        $table->timestamp('delivered_at')->nullable();

        // Stock management
        $table->boolean('stock_deducted')->default(false);

        $table->timestamps();

        // Indexes
        $table->index('customer_phone');
        $table->index('status');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
