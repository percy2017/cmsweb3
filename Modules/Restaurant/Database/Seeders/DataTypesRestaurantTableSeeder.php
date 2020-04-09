<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Models\DataType;
use Modules\Restaurant\Entities\Product;

class DataTypesRestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /**
         * --------- 1.- yimbo_products - MODULO INVENTARIO--------------------------
         */
        $dataType = $this->dataType('slug', 'yimbo_products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_products',
                'display_name_singular' => 'Producto',
                'display_name_plural'   => 'Productos',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Product',
                'policy_name'           => null,
                'controller'            => 'Modules\\Restaurant\\Http\\Controllers\\ProductController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
    
        $dataType = $this->dataType('slug', 'yimbo_sub_categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sub_categories',
                'display_name_singular' => 'Sub Categoria',
                'display_name_plural'   => 'Sub Categorias',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\SubCategory',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'yimbo_categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_categories',
                'display_name_singular' => 'Categoria',
                'display_name_plural'   => 'Categorias',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Category',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
 
        $dataType = $this->dataType('slug', 'yimbo_branch_offices');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_branch_offices',
                'display_name_singular' => 'Sucursale',
                'display_name_plural'   => 'Sucursales',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\BranchOffice',
                'policy_name'           => null,
                'controller'            => 'Modules\\Restaurant\\Http\\Controllers\\BranchOfficeController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
  
        $dataType = $this->dataType('slug', 'yimbo_supplies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_supplies',
                'display_name_singular' => 'Insumo',
                'display_name_plural'   => 'Insumos',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Supply',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'yimbo_extras');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_extras',
                'display_name_singular' => 'Extra',
                'display_name_plural'   => 'Extras',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Extra',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
        
          /**
         * ---------5.- DETAIL EXTRAS - MODULO VENTAS--------------------------
         */

        $dataType = $this->dataType('slug', 'yimbo_customers');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_customers',
                'display_name_singular' => 'Cliente',
                'display_name_plural'   => 'Clientes',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Customer',    
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'yimbo_cashes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_cashes',
                'display_name_singular' => 'Caja',
                'display_name_plural'   => 'Cajas',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Cash',    
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
   
        $dataType = $this->dataType('slug', 'yimbo_sales');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_sales',
                'display_name_singular' => 'Venta',
                'display_name_plural'   => 'Ventas',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Sale',    
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
   
        $dataType = $this->dataType('slug', 'yimbo_seats');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_seats',
                'display_name_singular' => 'Asiento',
                'display_name_plural'   => 'Asientos',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Seat',    
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
      
        $dataType = $this->dataType('slug', 'yimbo_detail_extras');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'yimbo_detail_extras',
                'display_name_singular' => 'Detalle Extra',
                'display_name_plural'   => 'Detalle Extras',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'Modules\\Restaurant\\Entities\\DetailExtra',    
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'  
                ]
            ])->save();
        }
        
        


    }

     /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
