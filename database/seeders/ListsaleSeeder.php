<?php

namespace Database\Seeders;

use App\Models\Listsale;
use Illuminate\Database\Seeder;

class ListsaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Listsale::factory()->count(5)->create();
    }
}
