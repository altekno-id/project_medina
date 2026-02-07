<?php

namespace Database\Seeders;

use App\Models\Master_bank;
use App\Models\MasterBank;
use App\Models\MasterBankTahapan;
use App\Models\MasterKawasan;
use App\Models\MasterKawasanSub;
use App\Models\MasterRab;
use App\Models\MasterRabItem;
use App\Models\UserClient;
use App\Models\UserLogin;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        UserClient::factory(10)->create();
        UserRole::factory(10)->create();
        UserLogin::factory(10)->create();
        MasterBank::factory(10)->create();
        MasterKawasan::factory(10)->create();
        MasterRab::factory(10)->create();
    }
}