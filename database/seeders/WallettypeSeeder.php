<?php

namespace Database\Seeders;

use App\Models\Wallettype;
use Illuminate\Database\Seeder;

class WallettypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallettype::factory()->count(5)->create();
    }
}
