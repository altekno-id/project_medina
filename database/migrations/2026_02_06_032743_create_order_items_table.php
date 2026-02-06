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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignId('order_unit_id')->constrained('order_units')->cascadeOnDelete();
            $table->foreignId('master_rab_item_id')->constrained('master_rab_items')->cascadeOnDelete();
            $table->decimal('qty', 18, 3);
            $table->decimal('harga_satuan', 18, 2);
            $table->decimal('subtotal', 18, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};