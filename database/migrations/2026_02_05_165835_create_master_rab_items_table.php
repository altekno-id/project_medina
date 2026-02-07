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
        Schema::create('master_rab_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignIdFor('master_rab_id')->constrained('master_rabs')->cascadeOnDelete();
            $table->string('nama_item', 150);
            $table->string('kategori_item', 30);
            $table->string('satuan', 30);
            $table->decimal('qty_rab', 18, 3)->default(0);
            $table->decimal('harga_satuan_rab', 18, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_rab_items');
    }
};
