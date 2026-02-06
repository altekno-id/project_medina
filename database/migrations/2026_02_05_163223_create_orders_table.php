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
            $table->foreignId('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignId('user_login_id')->constrained('user_logins')->cascadeOnDelete();
            $table->string('nomor_order', 50);
            $table->dateTime('tanggal_order');
            $table->enum('tipe_order',['PO','PERMINTAAN_DANA']);
            $table->unsignedTinyInteger('status_order')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
