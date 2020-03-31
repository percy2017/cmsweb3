<?php

namespace Modules\Streaming\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;
class PermissionTableSeederTableSeeder extends Seeder
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

        
        //Permisos----------------------------------------
        // -------------------------------------------------
        Permission::generateFor('sanes_accounts');
        // $keys = [
        //     'browse_accounts',
        //     'edit_accounts',
        //     'delete_accounts',
        // ];
        // foreach ($keys as $key) {
        //     Permission::firstOrCreate([
        //         'key'        => $key,
        //         'table_name' => 'accounts',
        //     ]);
        // }

        Permission::generateFor('sanes_memberships');


        Permission::generateFor('sanes_profiles');
        // $keys = [
        //     'browse_profiles',
        //     'edit_profiles',
        //     'delete_profiles',
        // ];
        // foreach ($keys as $key) {
        //     Permission::firstOrCreate([
        //         'key'        => $key,
        //         'table_name' => 'profiles',
        //     ]);
        // }

        
        Permission::generateFor('sanes_boxes');
        // $keys = [
        //     'browse_boxes',
        //     'edit_boxes',
        //     'delete_boxes'
        // ];
        // foreach ($keys as $key) {
        //     Permission::firstOrCreate([
        //         'key'        => $key,
        //         'table_name' => 'boxes',
        //     ]);
        // }


        Permission::generateFor('sanes_seatings');
        // $keys = [
        //     'browse_seatings',
        //     'edit_seatings',
        //     'delete_seatings'
        // ];
        // foreach ($keys as $key) {
        //     Permission::firstOrCreate([
        //         'key'        => $key,
        //         'table_name' => 'seatings',
        //     ]);
        // }

        Permission::generateFor('sanes_renovation_accounts');
        Permission::generateFor('sanes_renovation_profiles');


        // -----------------------------------------------------------
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', 'sanes_accounts')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
            
        $permissions = Permission::where('table_name', 'sanes_memberships')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'sanes_profiles')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'sanes_boxes')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
            

        $permissions = Permission::where('table_name', 'sanes_seatings')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'sanes_renovation_accounts')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'sanes_renovation_profiles')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
        //Permisos----------------------------------------
    }
}
