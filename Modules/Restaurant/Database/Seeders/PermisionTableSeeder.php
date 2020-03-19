<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\DB;
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
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', 'products')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'categories')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'sub_categories')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'branch_offices')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'supplies')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'extras')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
        
    }
}
