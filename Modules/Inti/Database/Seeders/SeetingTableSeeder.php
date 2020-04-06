<?php

namespace Modules\Inti\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SeetingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        DB::table('settings')
        ->where('key', 'site.title')
        ->update(['value' => 'Inti v1.0']);

        DB::table('settings')
            ->where('key', 'admin.title')
            ->update(['value' => 'Inti v1.0']);

        DB::table('settings')
            ->where('key', 'site.description')
            ->update(['value' => 'Software inteligente para la administracion y gestion de educacion en linea']);

        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => 'index']);
        }
}
