<?php

namespace Modules\CashFlow\Database\Seeders;

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

use Modules\CashFlow\Entities\Box;
use Modules\CashFlow\Entities\Seating;

class CashFlowDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       

        //DataTypes bread----------------------------------------
        // -------------------------------------------------
        $dataType = $this->dataType('slug', 'boxes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'boxes',
                'display_name_singular' => 'Cajas',
                'display_name_plural'   => 'Caja',
                'icon'                  => 'fa fa-boxes',
                'model_name'            => 'Modules\\CashFlow\\Entities\\Box',
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
        $dataType = $this->dataType('slug', 'seatings');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'seatings',
                'display_name_singular' => 'Asiento',
                'display_name_plural'   => 'Asientos',
                'icon'                  => 'fa fa-calculator',
                'model_name'            => 'Modules\\CashFlow\\Entities\\Seating',
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
        //End_DataTypes----------------------------------------


        // -------------------------------------------------
        //DataRows----------------------------------------
        // --------------------------------------------------
        $BoxDataType = DataType::where('slug', 'boxes')->firstOrFail();
        $SeatingDataType = DataType::where('slug', 'seatings')->firstOrFail();


        // FORM Cajas --------------------------------------------------
        // -----------------------------------------------------------
        $dataRow = $this->dataRow($BoxDataType, 'id');  //----1
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        
        $dataRow = $this->dataRow($BoxDataType, 'title'); //----2
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nombre Caja',
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

        $dataRow = $this->dataRow($BoxDataType, 'start_amount');//----3
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Importe de Inicio',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 3,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($BoxDataType, 'balance');//----4
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Saldo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 4,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($BoxDataType, 'status');//----5
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Estado',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 5,
                'details'      => [
                    
                        "on" => "Caja Abierta",
                        "off" => "Caja Cerrada",
                        "checked" => true
                   
                ]
            ])->save();
        }
        
        $dataRow = $this->dataRow($BoxDataType, 'user_id');//----6
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'Traking',
                'display_name' => 'Traking User',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($BoxDataType, 'created_at');
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
        $dataRow = $this->dataRow($BoxDataType, 'updated_at');
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
        $dataRow = $this->dataRow($BoxDataType, 'deleted_at');
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

        // FORM Asiento --------------------------------------------------
        // -----------------------------------------------------------
        $dataRow = $this->dataRow($SeatingDataType, 'id');//----1
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($SeatingDataType, 'concept');//----2
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Concepto',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 3,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($SeatingDataType, 'amount');//----3
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Monto',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 4,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($SeatingDataType, 'type');//----4
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Tipo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 5,
                'details'      => [
                      'options' => [
                          'ingresos' => 'INGRESOS',
                          'egresos' => 'EGRESOS'
                      ]
                ]
            ])->save();
        }
        
        $dataRow = $this->dataRow($SeatingDataType, 'user_id');//----5
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'Traking',
                'display_name' => 'Traking User',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 15,
            ])->save();
        }
        $dataRow = $this->dataRow($SeatingDataType, 'box_id');//----6
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Traking User',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($SeatingDataType, 'seating_belongsto_box_relationship');//----6
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Cajas',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model'       => 'Modules\\CashFlow\\Entities\\Box',
                    'table'       => 'boxes',
                    'type'        => 'belongsTo',
                    'column'      => 'box_id',
                    'key'         => 'id',
                    'label'       => 'title',
                    'pivot_table' => 'boxes',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($SeatingDataType, 'created_at');
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
        $dataRow = $this->dataRow($SeatingDataType, 'updated_at');
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
        $dataRow = $this->dataRow($SeatingDataType, 'deleted_at');
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

        



        //Menus-----------------------------------------
        //---------------------------------------------
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $BoxMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Flujo de Caja',
            'url'     => '',
        ]);
        if (!$BoxMenuItem->exists) {
            $BoxMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-browser',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Cajas',
            'url'     => '',
            'route'   => 'voyager.boxes.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $BoxMenuItem->id,
                'order'      => 1,
            ])->save();
        }

        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu->id,
        //     'title'   => 'Reportes',
        //     'url'     => '',
        //     'route'   => '',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-double-right',
        //         'color'      => null,
        //         'parent_id'  => $StreamingMenuItem->id,
        //         'order'      => 2,
        //     ])->save();
        // }

        //Menus --------------------------------------------------

        

        //Permisos----------------------------------------
        // -------------------------------------------------
        Permission::generateFor('boxes');
        Permission::generateFor('seatings');
        
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', 'boxes')->get();
        foreach ($permissions as $key){
            $rp = DB::table('permission_role')->where('permission_id', $key->id)->first();
            if (!$rp){
                DB::table('permission_role')->insert([
                    'permission_id' => $key->id, 
                    'role_id' => $role->id
                ]);
            }
        }
    
        
        $permissions = Permission::where('table_name', 'seatings')->get();
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


         //Datos Default -------------------------------------
        //-----------------------------------------------------

        $box = Box::create([
            'title'        => 'Title #1',
            'start_amount' => 0,
            'user_id'      =>  1
        ]);
        Seating::create([
            'concept'   => 'cocepto  #1',
            'amount'    => 100,
            'type'      => 'INGRESOS',
            'box_id'    => $box->id,
            'user_id'   => 1
        ]);
                
      

        //datos default----------------------------------------
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
