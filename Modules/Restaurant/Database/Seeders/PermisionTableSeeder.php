<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class PermisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
 
        Permission::generateFor('products');
        Permission::generateFor('categories');
        Permission::generateFor('sub_categories');
        Permission::generateFor('branch_offices'); //sucurales
        Permission::generateFor('supplies'); //suministros
        Permission::generateFor('extras');
        // Permission::generateFor('branchOffice_product');
        // Permission::generateFor('extra_product');
        // Permission::generateFor('branchOffice_extra');
    }
}
