<?php

use App\Models\MasterBankTahapan;
use App\Models\Unit;
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
        Schema::create('unit_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignIdFor(Unit::class)->constrained();
            $table->foreignIdFor(MasterBankTahapan::class)->constrained();
            $table->boolean('status_pencarian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_progress');
    }
};