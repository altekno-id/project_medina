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
        Schema::create('master_kawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignId('user_login_id')->constrained('user_logins')->cascadeOnDelete();
            $table->string('nama_master_kawasan', 150);
            $table->text('alamat_master_kawasan')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('info_master_kawasan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_kawasans');
    }
};
