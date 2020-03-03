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
        $dataType = $this->dataType('slug', 'accounts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'accounts',
                'display_name_singular' => 'Cuentas',
                'display_name_plural'   => 'Cuenta',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Account',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => null,
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'name',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'memberships');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'memberships',
                'display_name_singular' => 'Membresia',
                'display_name_plural'   => 'Membresias',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Membership',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => null,
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'title',
                    'scope'                => null
                ]
            ])->save();
        }
        $dataType = $this->dataType('slug', 'profiles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'profiles',
                'display_name_singular' => 'Perfiles',
                'display_name_plural'   => 'profiles',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Streaming\\Entities\\Profile',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => null,
                    'order_display_column' => null,
                    'order_direction'      => 'desc',
                    'default_search_key'   => 'fullname',
                    'scope'                => null
                ]
            ])->save();
        }
        //DataTypes----------------------------------------





        //DataRows----------------------------------------
        // --------------------------------------------------
        $AccountDataType = DataType::where('slug', 'accounts')->firstOrFail();
        $MembershipDataType = DataType::where('slug', 'memberships')->firstOrFail();
        $ProfileDataType = DataType::where('slug', 'profiles')->firstOrFail();

        // AccountDataType------------------------------------------------
        $dataRow = $this->dataRow($AccountDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Type',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'options' => [
                        'Netflix' => 'Netflix',
                        'Spotify' => 'Spotify'
                    ],
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'statu');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Estado',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'options'=>[
                        'Activo'=>'Activo',
                        'Inactivo'=>'Inactivo'
                    ],
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nombre',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Correo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Contraseña',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Costo',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'renovation');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Renovacion',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'quantity_profiles');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => '# de Perfiles',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Descripcion',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'Traking',
                'display_name' => 'Traking',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '12',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($AccountDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'deleted_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }

        // MembershipDataType------------------------------------------------
        $dataRow = $this->dataRow($MembershipDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Titulo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Descripcion',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Precio',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'Traking',
                'display_name' => 'Traking',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '12',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($MembershipDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'deleted_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }
        
        
        // ProfileDataType------------------------------------------------
        $dataRow = $this->dataRow($ProfileDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'profile_belongsto_account_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Cuenta',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'display' => [
                        'width' => 6
                    ],
                    'model'       => 'Modules\\Streaming\\Entities\\Account',
                    'table'       => 'accounts',
                    'type'        => 'belongsTo',
                    'column'      => 'account_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'accounts',
                    'pivot'       => 0,
                ],
                'order'        => 2,
                
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'account_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'account_id',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'profile_belongsto_membership_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Membresia',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'display' => [
                        'width' => 6
                    ],
                    'model'       => 'Modules\\Streaming\\Entities\\Membership',
                    'table'       => 'memberships',
                    'type'        => 'belongsTo',
                    'column'      => 'membership_id',
                    'key'         => 'id',
                    'label'       => 'title',
                    'pivot_table' => 'memberships',
                    'pivot'       => 0,
                ],
                'order'        => 2,
                
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'membership_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'membership_id',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'fullname');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nombre Completo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'phone');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Telefono',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'statu');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Estado',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'options'=>[
                        'Vigente'=>'Vigente',
                        'Finalizado'=>'Finalizado'
                    ],
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'startdate');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Inicio',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'observation');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Obs',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'finaldate');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Fin',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'Traking',
                'display_name' => 'Traking',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 2,
                'details'      => [
                    'display'   => [
                        'width'  => '12',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($ProfileDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'deleted_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }
        //-------------------------------------------------
        //DataRows----------------------------------------






        //Menus-----------------------------------------
        //---------------------------------------------
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $StreamingMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Streaming',
            'url'     => '',
        ]);
        if (!$StreamingMenuItem->exists) {
            $StreamingMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-play',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Cuentas',
            'url'     => '',
            'route'   => 'voyager.accounts.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $StreamingMenuItem->id,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Reportes',
            'url'     => '',
            'route'   => '',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $StreamingMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        //Menus --------------------------------------------------






        //Permisos----------------------------------------
        // -------------------------------------------------
        Permission::generateFor('accounts');
        Permission::generateFor('memberships');
        Permission::generateFor('profiles');

        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', 'accounts')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
    
        
        $permissions = Permission::where('table_name', 'memberships')->get();
        foreach ($permissions as $key) {
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp) {
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }

        $permissions = Permission::where('table_name', 'profiles')->get();
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

        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => 'index']);
        // Setting ------------------------------------



        //Datos Default -------------------------------------
        //-----------------------------------------------------

        $account = Account::create([
            'name' => 'Cuenta #1',
            'user_id' => 1
        ]);
        $menbership = Membership::create([
            'title'          => 'Membresia #1',
            'user_id'       => 1,
        ]);
                
            Profile::create([
                'fullname'       => 'Perfil #1',
                'account_id'     => $account->id,
                'membership_id'  => $menbership->id,
                'user_id'        => 1,
            ]); 
            Profile::create([
                'fullname'       => 'Perfil #2',
                'account_id'     => $account->id,
                'membership_id'  => $menbership->id,
                'user_id'        => 1,
            ]);  

        //datos default----------------------------------------

        //-------- bloques y pages ----------------------------
        //-----------------------------------------------------        
        $page = Page::create([
            'name'      => 'Page streaming',
            'slug'      => 'index',
            'direction' => 'streaming::index',
            'details'   => null
            
        ]);

        Block::create([
            'name'        => 'lpst_block1',
            'title'       => 'Blocke #1 (features #1)',
            'description' => 'Seccion Features #1 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Disfruta en tu TV.',
                    'width'  => 6
                ],
                'image1' => [
                    'type'   => 'image',
                    'name'   => 'image1',
                    'label'  => 'Imagen del block1',
                    'value'  => 'default.png',
                    'width'  => 6
                ],

                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Ve en smart TV, PlayStation, Xbox, Chromecast, Apple TV, reproductores de Blu-ray y más..',
                    'width'  => 12
                ]
            ])
        ]);
        
        Block::create([
            'name'        => 'lpst_block2',
            'title'       => 'Blocke #2 (Spotify #2)',
            'description' => 'Seccion Spotify #2 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 2,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Spotify Premiun.',
                    'width'  => 6
                ],

                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quam sapiente
                    molestiae numquam quas, voluptates omnis nulla ea odio.',
                    'width'  => 6
                ],

                'icons1' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons1',
                    'label' => 'Icon #1',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title1' => [
                    'type'  => 'text',
                    'name'  => 'title1',
                    'label' => 'titulo 1',
                    'value' => 'Feature One',
                    'width'  => 3
                ],

                'decription1' => [
                    'type'  => 'text_area',
                    'name'  => 'decription1',
                    'label' => 'descripcion # 1 ',
                    'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                    'width'  => 6
                ],

                'icons2' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons2',
                    'label' => 'Icon #2',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title2' => [
                    'type'  => 'text',
                    'name'  => 'title2',
                    'label' => 'titulo 2',
                    'value' => 'Feature two',
                    'width'  => 3
                ],

                'decription2' => [
                    'type'  => 'text_area',
                    'name'  => 'decription2',
                    'label' => 'descripcion # 2 ',
                    'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                    'width'  => 6
                ],

                'icons3' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons3',
                    'label' => 'Icon #3',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title3' => [
                    'type'  => 'text',
                    'name'  => 'title3',
                    'label' => 'titulo 3',
                    'value' => 'Feature Tree',
                    'width'  => 3
                ],

                'decription3' => [
                    'type'  => 'text_area',
                    'name'  => 'decription3',
                    'label' => 'descripcion # 3',
                    'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                    'width'  => 6
                ],

                'icons4' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons4',
                    'label' => 'Icon #4',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title4' => [
                    'type'  => 'text',
                    'name'  => 'title4',
                    'label' => 'titulo 4',
                    'value' => 'Feature Four',
                    'width'  => 3
                ],

                'decription4' => [
                    'type'  => 'text_area',
                    'name'  => 'decription4',
                    'label' => 'descripcion # 4',
                    'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                    'width'  => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpst_block3',
            'title'       => 'Blocke #3 (Pasarela de Pago #3)',
            'description' => 'Seccion Pasarela de Pago #3 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 3,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Spotify Premiun.',
                    'width'  => 6
                ],
                'description'=> [
                    'type'   => 'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion',
                    'value'  => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quam sapiente
                    molestiae',
                    'width'  => 6
                ],

                'image1'=> [
                    'type'   => 'image',
                    'name'   => 'image1',
                    'label'  => 'Imagen #1',
                    'value'  => 'default.png',
                    'width'  => 4
                ],
                'title1' => [
                    'type'   => 'text',
                    'name'   => 'title1',
                    'label'  => 'Titulo #1',
                    'value'  => 'Tigo Money',
                    'width'  => 4
                ],
                'account1' => [
                    'type'   => 'text',
                    'name'   => 'account1',
                    'label'  => 'Cuenta #1',
                    'value'  => 'Nro de Telefono: 78746621',
                    'width'  => 4
                ],

                'image2'=> [
                    'type'   => 'image',
                    'name'   => 'image2',
                    'label'  => 'Imagen #2',
                    'value'  => 'default.png',
                    'width'  => 4
                ],
                'title2' => [
                    'type'   => 'text',
                    'name'   => 'title2',
                    'label'  => 'Titulo #2',
                    'value'  => 'Banco BNB',
                    'width'  => 4
                ],
                'account2' => [
                    'type'   => 'text',
                    'name'   => 'account2',
                    'label'  => 'Cuenta #2',
                    'value'  => 'Nro de Cuenta: 8500183080',
                    'width'  => 4
                ],

                'image3'=> [
                    'type'   => 'image',
                    'name'   => 'image3',
                    'label'  => 'Imagen #3',
                    'value'  => 'default.png',
                    'width'  => 4
                ],
                'title3' => [
                    'type'   => 'text',
                    'name'   => 'title3',
                    'label'  => 'Titulo #3',
                    'value'  => 'Banco Union',
                    'width'  => 4
                ],
                'account3' => [
                    'type'   => 'text',
                    'name'   => 'account3',
                    'label'  => 'Cuenta #3',
                    'value'  => 'Nro de Cuenta: 10000013879305',
                    'width'  => 4
                ]
                
            ])    
        ]);

        Block::create([
            'name'        => 'lpst_block4',
            'title'       => 'Blocke #4 (Pricing #4)',
            'description' => 'Seccion Peicing #4 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 4,
            'details'     => json_encode([
                'title' => [
                    'type'   => 'text',
                    'name'   => 'title',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Pasarela de Pago.',
                    'width'  => 6
                ],
                'description' => [
                    'type'   => 'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion Corta',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam
                    eum porro a pariatur veniam.',
                    'width'  => 6
                ],

                'pricing1_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_title',
                    'label'  => 'Titulo #1',
                    'value'  => 'Netlix Premiun',
                    'width'  => 6
                ],
                'pricing1_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing1_price',
                    'label'  => 'Precio #1',
                    'value'  => '100',
                    'width'  => 6,
                    'step'   => '0,1',
                    'max'    => '190',
                    'min'    => '1'
                ],
                'pricing1_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description1',
                    'label'  => 'detalles del plan # 1',
                    'value'  => ' project',
                    'width'  => 3
                ],
                'pricing1_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description2',
                    'label'  => 'detalles del plan # 1',
                    'value'  => ' components',
                    'width'  => 3
                ],
                'pricing1_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description3',
                    'label'  => 'detalles del plan # 1',
                    'value'  => ' features',
                    'width'  => 3
                ],
                'pricing1_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_button4',
                    'label'  => 'Acion del Boton # 1',
                    'value'  => '#',
                    'width'  => 3
                ],

                'pricing2_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_title',
                    'label'  => 'Titulo #2',
                    'value'  => 'Spotify Premiun',
                    'width'  => 6
                ],
                'pricing2_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing2_price',
                    'label'  => 'Precio #2',
                    'value'  => '50',
                    'width'  => 6
                ],
                'pricing2_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description1',
                    'label'  => 'detalles del plan # 2',
                    'value'  => ' project',
                    'width'  => 3
                ],
                'pricing2_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description2',
                    'label'  => 'detalles del plan # 2',
                    'value'  => ' components',
                    'width'  => 3
                ],
                'pricing2_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description3',
                    'label'  => 'detalles del plan # 2',
                    'value'  => ' features',
                    'width'  => 3
                ],
                'pricing2_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_button4',
                    'label'  => 'Acion del Boton # 2',
                    'value'  => '#',
                    'width'  => 3
                ],

                'pricing3_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_title',
                    'label'  => 'Titulo #3',
                    'value'  => 'Disney Plus Premiun',
                    'width'  => 6
                ],
                'pricing3_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing3_price',
                    'label'  => 'Precio #3',
                    'value'  => '100',
                    'width'  => 6
                ],
                'pricing3_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description1',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' project',
                    'width'  => 3
                ],
                'pricing3_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description2',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' components',
                    'width'  => 3
                ],
                'pricing3_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description3',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' features',
                    'width'  => 3
                ],
                'pricing3_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_button4',
                    'label'  => 'Acion del Boton # 3',
                    'value'  => '#',
                    'width'  => 3
                ]
 
            ])    
        ]);
        
        

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
