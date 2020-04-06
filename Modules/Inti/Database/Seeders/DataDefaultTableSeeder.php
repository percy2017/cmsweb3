<?php

namespace Modules\Inti\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Inti\Entities\IntiCourse;

class DataDefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        IntiCourse::create([
            'title' => 'Curso Ofimatica',
            'slug'  => 'curso-ofimatica',
            'image' => 'Modules/Inti/public/images/curso-ofimatica.png',
            'body'  => 'Curso Ofimatica body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Excel',
            'slug'  => 'curso-excel',
            'image' => 'Modules/Inti/public/images/curso-excel.png',
            'body'  => 'Curso excel body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Laravel',
            'slug'  => 'curso-laravel',
            'image' => 'Modules/Inti/public/images/curso-laravel.png',
            'body'  => 'Curso laravel body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Mysql',
            'slug'  => 'curso-mysql',
            'image' => 'Modules/Inti/public/images/curso-mysql.png',
            'body'  => 'Curso mysql body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Programacion',
            'slug'  => 'curso-programacion',
            'image' => 'Modules/Inti/public/images/curso-programacion.png',
            'body'  => 'Curso programacion body',
            'user_id' => 1
        ]);
        // $post = $this->findPost('curso-pyton');
        // if (!$post->exists) {
        //     $post->fill([
        //         'title'            => 'Curso Pyton',
        //         'slug'             => 'curso-pyton',
        //         'image'            => 'Modules/Inti/public/images/curso-pyton.png',
        //         'body'             => '<p>This is the body of the lorem ipsum post</p>',
        //     ])->save();
        // }
    
    }
    protected function findPost($slug)
    {
        return IntiCourse::firstOrNew(['slug' => $slug]);
    }
}
