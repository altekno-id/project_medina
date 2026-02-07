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
        Schema::create('master_kawasan_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignIdFor('master_kawasan_id')->constrained('master_kawasans')->cascadeOnDelete();
            $table->string('nama_master_kawasan_sub', 150);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_kawasan_subs');
    }
};