<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
	
        
        DB::table('settings')
            ->where('key', 'site.title')
            ->update(['value' => 'YIMBO v1.0']);

        DB::table('settings')
            ->where('key', 'admin.title')
            ->update(['value' => 'YIMBO v1.0']);

        DB::table('settings')
            ->where('key', 'site.description')
            ->update(['value' => 'Software inteligente para la administracion y gestion de restaurant y venta de comida rapida.']);

        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => 'index']);
    }
}
