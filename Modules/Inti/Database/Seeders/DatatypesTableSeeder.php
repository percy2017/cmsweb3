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
                'icon'                  => 'voyager-bag',
                'model_name'            => 'Modules\\Inti\\Entities\\IntiCourse',
                'policy_name'           => null,
                'controller'            => 'Modules\\Inti\\Http\\Controllers\\CoursesController',
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
