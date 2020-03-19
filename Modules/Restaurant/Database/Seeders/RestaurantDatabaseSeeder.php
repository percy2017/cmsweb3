<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RestaurantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.  
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        $this->call(SettingsTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(DataTypesRestaurantTableSeeder::class);
        $this->call(DataRowsRestaurantTableSeeder::class);
        $this->call(PermisionTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(DatosDefaultTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
