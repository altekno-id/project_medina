<?php

use App\Models\MasterBank;
use App\Models\MasterKawasan;
use App\Models\MasterKawasanSub;
use App\Models\MasterKawasanSubBlok;
use App\Models\MasterRab;
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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MasterKawasan::class)->nullable()->constrained();
            $table->foreignIdFor(MasterKawasanSub::class)->nullable()->constrained();
            $table->foreignIdFor(MasterKawasanSubBlok::class)->nullable()->constrained();
            $table->foreignIdFor(MasterRab::class)->constrained();
            $table->foreignIdFor(MasterBank::class)->constrained();
            $table->string('nama_jalan', 150)->nullable();
            $table->string('nomor_unit', 50);
            $table->string('tipe_unit', 50)->nullable();
            $table->decimal('harga_unit', 18, 2);
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
        Schema::dropIfExists('units');
    }
};
