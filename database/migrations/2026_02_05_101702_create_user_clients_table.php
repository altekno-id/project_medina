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
        Schema::create('user_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 150);
            $table->text('alamat_perusahaan');
            $table->string('telepon_perusahaan', 30);
            $table->string('email_perusahaan', 150);
            $table->string('nama_pimpinan', 150);
            $table->json('info_user_client');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_clients');
    }
};