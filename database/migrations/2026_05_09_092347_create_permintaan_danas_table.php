<?php

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
        Schema::create('permintaan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_permintaan');
            $table->unsignedInteger('jumlah_permintaan');
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
        Schema::dropIfExists('permintaan_danas');
    }
};
