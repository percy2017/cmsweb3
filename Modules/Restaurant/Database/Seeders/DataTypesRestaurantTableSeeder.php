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
         * ---------PRODUCTS-------------------------
         */
        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Producto',
                'display_name_plural'   => 'Productos',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Product',
                'policy_name'           => null,
                'controller'            => 'Modules\\Restaurant\\Http\\Controllers\\ProductController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
            ])->save();
        }
         /**
         * ---------SUB CSTEGORIAS-------------------------
         */
        $dataType = $this->dataType('slug', 'sub_categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sub_categories',
                'display_name_singular' => 'Sub Categoria',
                'display_name_plural'   => 'Sub Categorias',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'Modules\\Restaurant\\Entities\\SubCategory',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
            ])->save();
        }
        /**
         * --------- CATEGORIAS-------------------------
         */
        $dataType = $this->dataType('slug', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'categories',
                'display_name_singular' => 'Categoria',
                'display_name_plural'   => 'Categorias',
                'icon'                  => 'voyager',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Category',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
            ])->save();
        }
        /**
         * --------- SUCURSALES-------------------------
         */
        $dataType = $this->dataType('slug', 'branch_offices');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'branch_offices',
                'display_name_singular' => 'Sucursale',
                'display_name_plural'   => 'Sucursales',
                'icon'                  => 'voyager',
                'model_name'            => 'Modules\\Restaurant\\Entities\\BranchOffice',
                'policy_name'           => null,
                'controller'            => 'Modules\\Restaurant\\Http\\Controllers\\BranchOfficeController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
            ])->save();
        }
        /**
         * --------- INSUMOS-------------------------
         */
        $dataType = $this->dataType('slug', 'supplies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'supplies',
                'display_name_singular' => 'Insumo',
                'display_name_plural'   => 'Insumos',
                'icon'                  => 'voyager',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Supply',
                'policy_name'           => null,
                'controller'            => 'Modules\\Restaurant\\Http\\Controllers\\SupplyController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
            ])->save();
        }
        /**
         * --------- EXTRAS-------------------------
         */
        $dataType = $this->dataType('slug', 'extras');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'extras',
                'display_name_singular' => 'Extra',
                'display_name_plural'   => 'Extras',
                'icon'                  => 'voyager',
                'model_name'            => 'Modules\\Restaurant\\Entities\\Extra',
                'policy_name'           => null,
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => null
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
