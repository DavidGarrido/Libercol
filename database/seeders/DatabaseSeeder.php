<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            /* DepartamentSeeder::class,
            MunicipalitySeeder::class,
            CompanySeeder::class,
            IndustrySeeder::class,
            FiscalSeeder::class,
            TaxSeeder::class,
            AddressSeeder::class,
            ContactSeeder::class,
            FileSeeder::class,
            PointSeeder::class,
            InventarySeeder::class,
            TicketSeeder::class,
            AssetSeeder::class,
            FeatureSeeder::class,
            ColorSeeder::class,
            MaterialSeeder::class,
            ListsaleSeeder::class,
            ProductSeeder::class,
            ExtraSeeder::class,
            WallettypeSeeder::class,
            WalletSeeder::class,
            WalletmovimentSeeder::class,
            BankSeeder::class,
            UserdataSeeder::class,
            ClientSeeder::class,
            ScoreSeeder::class,
            CategorySeeder::class, */
            RoleSeeder::class,
        ]);
    }
}
