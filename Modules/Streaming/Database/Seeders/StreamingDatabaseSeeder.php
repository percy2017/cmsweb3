<?php

namespace Modules\Streaming\Database\Seeders;

use App\Actions\Blocks;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Setting;

use Modules\Streaming\Entities\Account;
use Modules\Streaming\Entities\Membership;
use Modules\Streaming\Entities\Profile;

use App\Page;
use App\Block;

use Modules\Streaming\Entities\Box;
use Modules\Streaming\Entities\Seating;

class StreamingDatabaseSeeder extends Seeder
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

        //DataTypes----------------------------------------
        // -------------------------------------------------
        $dataType = $this->dataType('slug', 'sanes_accounts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_accounts',
                'display_name_singular' => 'Cuenta',
                'display_name_plural'   => 'Cuentas',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Account',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\AccountController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'name',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_memberships');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_memberships',
                'display_name_singular' => 'Membresia',
                'display_name_plural'   => 'Membresias',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Membership',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\MembershipController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'title',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_profiles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_profiles',
                'display_name_singular' => 'Perfil',
                'display_name_plural'   => 'Perfiles',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Profile',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\ProfilesController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'fullname',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_boxes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_boxes',
                'display_name_singular' => 'Caja',
                'display_name_plural'   => 'Cajas',
                'icon'                  => 'voyager-logbook',
                'model_name'            => 'Modules\\Streaming\\Entities\\Box',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\BoxController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'name',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_seatings');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_seatings',
                'display_name_singular' => 'Asiento',
                'display_name_plural'   => 'Asientos',
                'icon'                  => 'fa fa-calculator',
                'model_name'            => 'Modules\\Streaming\\Entities\\Seating',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\SeatingController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'concept',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_renovation_accounts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_renovation_accounts',
                'display_name_singular' => 'Renovacion de Cuenta',
                'display_name_plural'   => 'Renovacion de Cuentas',
                'icon'                  => 'voyager-data',
                'model_name'            => 'Modules\\Streaming\\Entities\\SanesRenovationAccount',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\RCuentasController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'sanes_renovation_profiles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sanes_renovation_profiles',
                'display_name_singular' => 'Renovacion de Perfil',
                'display_name_plural'   => 'Renovacion de Perfiles',
                'icon'                  => 'voyager-data',
                'model_name'            => 'Modules\\Streaming\\Entities\\SanesRenovationProfile',
                'policy_name'           => null,
                'controller'            => 'Modules\\Streaming\\Http\\Controllers\\RProfilesController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }
        //DataTypes----------------------------------------

        $this->call(DataRowsTableSeederTableSeeder::class);

        $this->call(MenusTableSeederTableSeeder::class);

        $this->call(PermissionTableSeederTableSeeder::class);


        // Setting ------------------------------------
        // -----------------------------------------------
        $setting = $this->findSetting('streaming.mensaje1');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Mensaje 1',
                'value'        => 'le mandamos este mensaje para informarle que su membresia del servcio',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 1,
                'group'        => 'Streaming',
            ])->save();
        }

        $setting = $this->findSetting('streaming.mensaje2');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Mensaje 2',
                'value'        => 'ya finalizo, le invitamos a renovar con nuestra promo :',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 2,
                'group'        => 'Streaming',
            ])->save();
        }

        // DB::table('settings')
        //     ->where('key', 'site.page')
        //     ->update(['value' => 'index']);

        DB::table('settings')
            ->where('key', 'site.title')
            ->update(['value' => 'SANES v1.0']);

        DB::table('settings')
            ->where('key', 'admin.title')
            ->update(['value' => 'SANES v1.0']);

        DB::table('settings')
            ->where('key', 'site.description')
            ->update(['value' => 'Software para la administracion y gestion de negocios de entretenimiento por streaming.']);

        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => 'index']);
        // Setting ------------------------------------



        //Datos Default -------------------------------------
        //-----------------------------------------------------
        // $account = Account::create([
        //     'name' => 'Cuenta #1',
        //     'user_id' => 1
        // ]);
        $menbership = Membership::create([
            'title' => 'Membresia #1 Netflix (40 Bs)',
            'price' => 40,
            'months' => 1,
            'user_id' => 1,
        ]);
        $menbership = Membership::create([
            'title' => 'Membresia #2 Netflix (100 Bs)',
            'price' => 100,
            'months' => 3,
            'user_id' => 1,
        ]);

        //     Profile::create([
        //         'fullname'       => 'Perfil #1',
        //         'account_id'     => $account->id,
        //         'membership_id'  => $menbership->id,
        //         'user_id'        => 1,
        //     ]); 
            // Profile::create([
            //     'fullname'       => 'Perfil #2',
            //     'account_id'     => $account->id,
            //     'membership_id'  => $menbership->id,
            //     'user_id'        => 1,
            // ]);  

        $box = Box::create([
            'title'        => 'Caja de Apertura #1',
            'status'       =>  1,
            'balance'      =>  0,
            'start_amount' =>  0,
            'user_id'      =>  1
        ]);
        // Seating::create([
        //     'concept'   => 'cocepto  #1',
        //     'amount'    => 100,
        //     'type'      => 'INGRESOS',
        //     'box_id'    => $box->id,
        //     'user_id'   => 1
        // ]);

        //datos default----------------------------------------
        //-----------------------------------------------------     
        
    
        $this->call(PageTableSeeder::class);
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }

    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }

    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
