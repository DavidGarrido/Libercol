<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departament::create(['name' => 'Antioquia', 'code' =>  5]);
        Departament::create(['name' => 'Atlantico', 'code' =>  8]);
        Departament::create(['name' => 'D. C. Santa Fe de Bogotá', 'code' =>  11]);
        Departament::create(['name' => 'Bolivar', 'code' =>  13]);
        Departament::create(['name' => 'Boyaca', 'code' =>  15]);
        Departament::create(['name' => 'Caldas', 'code' =>  17]);
        Departament::create(['name' => 'Caqueta', 'code' =>  18]);
        Departament::create(['name' => 'Cauca', 'code' =>  19]);
        Departament::create(['name' => 'Cesar', 'code' =>  20]);
        Departament::create(['name' => 'Cordova', 'code' =>  23]);
        Departament::create(['name' => 'Cundinamarca', 'code' =>  25]);
        Departament::create(['name' => 'Choco', 'code' =>  27]);
        Departament::create(['name' => 'Huila', 'code' =>  41]);
        Departament::create(['name' => 'La Guajira', 'code' =>  44]);
        Departament::create(['name' => 'Magdalena', 'code' =>  47]);
        Departament::create(['name' => 'Meta', 'code' =>  50]);
        Departament::create(['name' => 'Nariño', 'code' =>  52]);
        Departament::create(['name' => 'Norte de Santander', 'code' =>  54]);
        Departament::create(['name' => 'Quindio', 'code' =>  63]);
        Departament::create(['name' => 'Risaralda', 'code' =>  66]);
        Departament::create(['name' => 'Santander', 'code' =>  68]);
        Departament::create(['name' => 'Sucre', 'code' =>  70]);
        Departament::create(['name' => 'Tolima', 'code' =>  73]);
        Departament::create(['name' => 'Valle', 'code' =>  76]);
        Departament::create(['name' => 'Arauca', 'code' =>  81]);
        Departament::create(['name' => 'Casanare', 'code' =>  85]);
        Departament::create(['name' => 'Putumayo', 'code' =>  86]);
        Departament::create(['name' => 'San Andres', 'code' =>  88]);
        Departament::create(['name' => 'Amazonas', 'code' =>  91]);
        Departament::create(['name' => 'Guainia', 'code' =>  94]);
        Departament::create(['name' => 'Guaviare', 'code' =>  95]);
        Departament::create(['name' => 'Vaupes', 'code' =>  97]);
        Departament::create(['name' => 'Vichada', 'code' =>  99]);
    }
}
