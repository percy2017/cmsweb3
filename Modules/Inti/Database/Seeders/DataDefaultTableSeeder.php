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
            
            'body'  => 'Curso Ofimatica body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Excel',
            'slug'  => 'curso-excel',
            
            'body'  => 'Curso excel body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Laravel',
            'slug'  => 'curso-laravel',
            
            'body'  => 'Curso laravel body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Mysql',
            'slug'  => 'curso-mysql',
            
            'body'  => 'Curso mysql body',
            'user_id' => 1
        ]);
        IntiCourse::create([
            'title' => 'Curso Programacion',
            'slug'  => 'curso-programacion',
            
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
