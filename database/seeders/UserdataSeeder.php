<?php

namespace Database\Seeders;

use App\Models\Userdata;
use Illuminate\Database\Seeder;

class UserdataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Userdata::factory()->count(5)->create();
    }
}
