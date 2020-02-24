<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use Modules\Ecommerce\Entities\Categorie;
use Modules\Ecommerce\Entities\Product;
use Modules\Ecommerce\Entities\Detail;

class EcommerceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        //DataTypes----------------------------------------
        // -------------------------------------------------
        $dataType = $this->dataType('slug', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'categories',
                'display_name_singular' => 'Categoria',
                'display_name_plural'   => 'Categorias',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Ecommerce\\Entities\\Categorie',
                'policy_name'           => '',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Producto',
                'display_name_plural'   => 'Productos',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Ecommerce\\Entities\\Product',
                'policy_name'           => '',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        $dataType = $this->dataType('slug', 'details');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'details',
                'display_name_singular' => 'Detalle',
                'display_name_plural'   => 'Detalles',
                'icon'                  => 'voyager-play',
                'model_name'            => 'Modules\\Ecommerce\\Entities\\Detail',
                'policy_name'           => '',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        //DataTypes----------------------------------------


        //DataRows----------------------------------------
        // --------------------------------------------------
        $CategorieDataType = DataType::where('slug', 'categories')->firstOrFail();
        $ProductDataType = DataType::where('slug', 'products')->firstOrFail();
        $DetailDataType = DataType::where('slug', 'details')->firstOrFail();
        // Categorias------------------------------------------------
        $dataRow = $this->dataRow($CategorieDataType, 'id');
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
        $dataRow = $this->dataRow($CategorieDataType, 'created_at');
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
        $dataRow = $this->dataRow($CategorieDataType, 'updated_at');
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
        $dataRow = $this->dataRow($CategorieDataType, 'deleted_at');
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

        // Products------------------------------------------------
        $dataRow = $this->dataRow($ProductDataType, 'id');
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
        $dataRow = $this->dataRow($ProductDataType, 'created_at');
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
        $dataRow = $this->dataRow($ProductDataType, 'updated_at');
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
        $dataRow = $this->dataRow($ProductDataType, 'deleted_at');
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
        
        
        // DetailDataType------------------------------------------------
        $dataRow = $this->dataRow($DetailDataType, 'id');
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
        $dataRow = $this->dataRow($DetailDataType, 'created_at');
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
        $dataRow = $this->dataRow($DetailDataType, 'updated_at');
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
        $dataRow = $this->dataRow($DetailDataType, 'deleted_at');
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

        $EcommerceMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'E-commerce',
            'url'     => '',
        ]);
        if (!$EcommerceMenuItem->exists) {
            $EcommerceMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-play',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Productos',
            'url'     => '',
            'route'   => 'voyager.products.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $EcommerceMenuItem->id,
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
                'parent_id'  => $EcommerceMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        //Menus --------------------------------------------------









        //Permisos----------------------------------------
        // -------------------------------------------------
        Permission::generateFor('categories');
        Permission::generateFor('products');
        Permission::generateFor('details');

        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', 'categories')->get();
        foreach ($permissions as $key) {
            DB::table('permission_role')->insert([
                'permission_id' => $key->id, 
                'role_id' => $role->id
            ]);
        }
        $permissions = Permission::where('table_name', 'products')->get();
        foreach ($permissions as $key) {
            DB::table('permission_role')->insert([
                'permission_id' => $key->id, 
                'role_id' => $role->id
            ]);
        }
        $permissions = Permission::where('table_name', 'details')->get();
        foreach ($permissions as $key) {
            DB::table('permission_role')->insert([
                'permission_id' => $key->id, 
                'role_id' => $role->id
            ]);
        }

        //Permisos----------------------------------------




        //Datos Default -------------------------------------
        //-----------------------------------------------------

        $category = Categorie::create([
            'name' => 'Category Prueba',
            'slug' => 'category-prueba'
        ]);
            $product = Product::create([
                'name'          => 'Product Name',
                'slug'          => 'product-name',
                'user_id'       => 1,
                'categorie_id'  => $category->id
            ]); 
                
                Detail::create([
                    'title'          => 'Detail',
                    'price'          => 100,
                    'user_id'       => 1,
                    'product_id'  => $product->id
                ]); 
                Detail::create([
                    'title'          => 'Detail',
                    'price'          => 100,
                    'user_id'       => 1,
                    'product_id'  => $product->id
                ]);  

            Product::create([
                'name'          => 'Product2 Name',
                'slug'          => 'product2-name',
                'user_id'       => 1,
                'categorie_id'  => $category->id
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
}
