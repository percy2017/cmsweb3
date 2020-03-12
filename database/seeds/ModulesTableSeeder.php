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
        $module = Module::create([
            'installed'         => false,
            'name'              => 'Blog',
            'description_short' => 'Modulo de Blog'
        ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Streaming',
            'description_short' => 'Modulo de Streaming'
        ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Deni',
            'description_short' => 'Modulo DENI'
        ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Ecommerce',
            'description_short' => 'Modulo de Comercio Electronico'
        ]);

        $module = Module::create([
            'installed'         => false,
            'name'              => 'Rokola',
            'description_short' => 'Modulo Rokola'
        ]);

    }
}
