<?php

namespace Modules\Streaming\Database\Seeders;

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

        //bloques y pages------------------------        
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
        
        //seting-----------------------------------
        

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
