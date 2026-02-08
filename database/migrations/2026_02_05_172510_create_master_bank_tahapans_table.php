<?php

use App\Models\MasterBank;
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
        Schema::create('master_bank_tahapans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignIdFor(MasterBank::class)->constrained();
            $table->string('nama_tahapan', 100);
            $table->float('nilai_progress')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_bank_tahapans');
    }
};
