<?php

use App\Models\MasterKawasan;
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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignIdFor(MasterKawasan::class)->nullable()->constrained();
            $table->foreignIdFor(Unit::class)->nullable()->constrained();
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