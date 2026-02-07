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
        Schema::create('unit_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignIdFor('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignIdFor('master_bank_tahapan_id')->constrained('master_bank_tahapans')->cascadeOnDelete();
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
