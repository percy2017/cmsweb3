<?php

namespace Modules\Inti\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
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
         * dataType
         * */
        $CourseDataType = DataType::where('slug', 'inti_courses')->firstOrFail();

        /**
         * ------------------------------------------------
         *               Formulario Course
         * -----------------------------------------------
         */
        $postion=1;

        $dataRow = $this->dataRow($CourseDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => [
                    'displey' => [
                        'width' => '6'
                    ],
                    'actions' => [
                        'table' => 'sanes_profiles',
                        'key' => 'account_id',
                        'type' => 'create',
                        'message' => 'Nuevo Perfil'
                    ]
                ],
                'order'        => $postion++,
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'title');
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
                'order'        => $postion++,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'displey' => [
                        'width' => '6'
                    ] 
                ],
                'order'  => $postion++,
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Imagen',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => $postion++,
                'details'      => [
                    'display'   => [
                        'width'  => '6',
                    ],
                ]
            ])->save();
        }
        
        $dataRow = $this->dataRow($CourseDataType, 'inti_content_belongsto_inti_course_relationship');//----6
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Contenido',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'display' => [
                        'width' => '6'
                    ],
                    'model'       => 'Modules\\Inti\\Entities\\IntiContent',
                    'table'       => 'inti_contents',
                    'type'        => 'belongsTo',
                    'column'      => 'inti_content_id',
                    'key'         => 'id',
                    'label'       => 'title',
                    'pivot_table' => 'inti_contents',
                    'pivot'       => 0,
                ],
                'order'        => $postion++,
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'body');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Body',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => $postion++,
                'details'      => [
                    'display'   => [
                        'width'  => '12',
                    ],
                ]
            ])->save();
        }
        $dataRow = $this->dataRow($CourseDataType, 'inti_content_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Content',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => $postion++,
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'created_at');
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
                'order'        => $postion++,
                'details'      => [
                    'width' => '3'
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'updated_at');
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
                'order'        => $postion++,
                'details'      => [
                    'width' => '3'
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($CourseDataType, 'deleted_at');
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
                'order'        => $postion++,
                'details'      => [
                    'width' => '3'
                ]
            ])->save();
        }




    }

    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
