<?php

namespace Database\Seeders;

use App\Models\Inventary;
use Illuminate\Database\Seeder;

class InventarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventary::factory()->count(5)->create();
    }
}
