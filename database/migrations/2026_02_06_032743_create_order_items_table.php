<?php

use App\Models\MasterRabItem;
use App\Models\OrderUnit;
use App\Models\UserClient;
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
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignIdFor(OrderUnit::class)->constrained();
            $table->foreignIdFor(MasterRabItem::class)->constrained();
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
