<?php

namespace Database\Seeders;

use App\Models\Master_bank;
use Database\Factories\MasterBankFactory;
use Database\Factories\MasterBankTahapanFactory;
use Database\Factories\MasterKawasanFactory;
use Database\Factories\MasterKawasanSubFactory;
use Database\Factories\MasterRabFactory;
use Database\Factories\MasterRabItemFactory;
use Database\Factories\UserClientFactory;
use Database\Factories\UserLoginFactory;
use Database\Factories\UserRoleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserClientFactory::new()->count(10)->create();
        UserRoleFactory::new()->count(10)->create();
        UserLoginFactory::new()->count(10)->create();
        MasterBankFactory::new()->count(10)->create();
        MasterBankTahapanFactory::new()->count(10)->create();
        MasterKawasanFactory::new()->count(10)->create();
        MasterKawasanSubFactory::new()->count(10)->create();
        MasterRabFactory::new()->count(10)->create();
        MasterRabItemFactory::new()->count(10)->create();
    }
}
