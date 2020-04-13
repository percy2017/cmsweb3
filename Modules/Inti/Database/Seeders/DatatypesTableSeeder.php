<?php

namespace Modules\Inti\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\DataType;

class DatatypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $dataType = $this->dataType('slug', 'inti_courses');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'inti_courses',
                'display_name_singular' => 'Curso',
                'display_name_plural'   => 'Cursos',
                'icon'                  => 'fa fa-id-badge',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiCourse',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\CoursesController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'inti_contents');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'inti_contents',
                'display_name_singular' => 'Contenido',
                'display_name_plural'   => 'Contenidos',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiContent',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\ContentsController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'inti_lives');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'inti_lives',
                'display_name_singular' => 'Live',
                'display_name_plural'   => 'Lives',
                'icon'                  => 'fa fa-eercast',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiLive',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\LivesController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'inti_calendars');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'inti_calendars',
                'display_name_singular' => 'Calendario',
                'display_name_plural'   => 'Calendarios',
                'icon'                  => 'fa fa-calendar',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiCalendar',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\CalendarsController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'                => null
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'inti_trainers');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'inti_trainers',
                'display_name_singular' => 'Trainer',
                'display_name_plural'   => 'Trainers',
                'icon'                  => 'fa fa-user-circle',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiTrainer',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\TrainersController',
                'generate_permissions'  => 1,
                'description'           => null,
                'server_side'           => 1,
                'details'               => [
                    'order_column'         => 'id',
                    'order_display_column' => 'id',
                    'order_direction'      => 'asc',
                    'default_search_key'   => 'id',
                    'scope'                => null
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
