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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignId('master_kawasan_sub_id')->nullable()->constrained('master_kawasan_subs')->cascadeOnDelete();
            $table->foreignId('master_rab_id')->constrained('master_rabs')->cascadeOnDelete();
            $table->foreignId('master_bank_id')->constrained('master_banks')->cascadeOnDelete();
            $table->string('nama_jalan', 150)->nullable();
            $table->string('nomor_unit', 50);
            $table->string('tipe_unit', 50)->nullable();
            $table->decimal('harga_unit', 18, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
