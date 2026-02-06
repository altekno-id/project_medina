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
        Schema::create('master_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignId('user_login_id')->constrained('user_logins')->cascadeOnDelete();
            $table->string('nama_master_bank', 150);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_banks');
    }
};
