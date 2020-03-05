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
    }
}
