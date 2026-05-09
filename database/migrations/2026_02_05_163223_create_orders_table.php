<?php

use App\Models\UserClient;
use App\Models\UserLogin;
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
            $table->foreignIdFor(UserLogin::class)->constrained();
            $table->string('nomor_order', 50);
            $table->dateTime('tanggal_order');
            $table->enum('tipe_order', ['PO', 'PERMINTAAN_DANA']);
            $table->unsignedTinyInteger('status_order')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignId('created_by')->constrained('user_logins');
            $table->foreignId('updated_by')->constrained('user_logins');
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
