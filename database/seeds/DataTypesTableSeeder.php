<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => 'TCG\Voyager\Http\Controllers\VoyagerRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        // pages ----------------------------------
        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Pagina',
                'display_name_plural'   => 'Paginas',
                'icon'                  => 'voyager-browser',
                'model_name'            => 'App\\Page',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
            ])->save();
        }
        //pages ------------------------------------

        // pages ----------------------------------
        $dataType = $this->dataType('slug', 'blocks');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'blocks',
                'display_name_singular' => 'Pagina',
                'display_name_plural'   => 'Paginas',
                'icon'                  => 'voyager-wallet',
                'model_name'            => 'App\\Block',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => null,
            ])->save();
        }
        //pages ------------------------------------
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
