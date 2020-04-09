<?php

use Illuminate\Database\Seeder;
use App\Module;
class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $module = Module::create([
        //     'installed'         => false,
        //     'name'              => 'Blog',
        //     'description_short' => 'Modulo de Blog'
        // ]);

        // $module = Module::create([
        //     'installed'         => false,
        //     'name'              => 'Sanes v1.0',
        //     'description_short' => 'Paquete para crea'
        // ]);

        // $module = Module::create([
        //     'installed'         => false,
        //     'name'              => 'Deni',
        //     'description_short' => 'Modulo DENI'
        // ]);

        // $module = Module::create([
        //     'installed'         => false,
        //     'name'              => 'Ecommerce',
        //     'description_short' => 'Modulo de Comercio Electronico'
        // ]);

        // $module = Module::create([
        //     'installed'         => false,
        //     'name'              => 'Rokola',
        //     'description_short' => 'Modulo Rokola'
        // ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Lisa v1.0',
            'description_short' => 'Paquete para crear y administrar centros educativos'
        ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Yimbo v1.0',
            'description_short' => 'Paquete para crear y gestionar negocios de Venta de Comdida y Restaurant'
        ]);
    }
}
