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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('user_client_id')->constrained('user_clients')->cascadeOnDelete();
            $table->foreignIdFor('master_kawasan_id')->nullable()->constrained('master_kawasans')->cascadeOnDelete();
            $table->foreignIdFor('unit_id')->nullable()->constrained('units')->cascadeOnDelete();
            $table->string('judul_file', 150)->nullable();
            $table->string('nama_file', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
