<?php

namespace Database\Seeders;

use App\Models\Fiscal;
use Illuminate\Database\Seeder;

class FiscalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fiscal::factory()->count(5)->create();
    }
}
