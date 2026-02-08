<?php

use App\Models\UserClient;
use App\Models\UserRole;
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
        Schema::create('user_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserClient::class)->constrained();
            $table->foreignIdFor(UserRole::class)->constrained();
            $table->string('username', 60);
            $table->string('password', 255);
            $table->string('nickname', 80)->nullable();
            $table->string('photo', 255)->nullable();
            $table->unsignedTinyInteger('status_user_login')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logins');
    }
};
