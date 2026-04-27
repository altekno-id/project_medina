<?php

use App\Models\MasterKawasanSub;
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
        Schema::create('master_kawasan_sub_bloks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MasterKawasanSub::class)->constrained();
            $table->string('nama_master_kawasan_sub_blok', 150);
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
        Schema::dropIfExists('master_kawasan_sub_bloks');
    }
};
