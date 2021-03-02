<?php

namespace Database\Seeders;

use App\Models\Walletmoviment;
use Illuminate\Database\Seeder;

class WalletmovimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Walletmoviment::factory()->count(5)->create();
    }
}
