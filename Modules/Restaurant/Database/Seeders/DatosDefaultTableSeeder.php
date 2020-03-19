<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Restaurant\Entities\Category;
use Modules\Restaurant\Entities\SubCategory;

class DatosDefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categoria=Category::create([
            'name'      => 'Pizzas',
            'slug'        => 'pizzas',  
            'description' => 'Sabor y calidad',
            'image'      =>  null,
            'colour'       =>  null  
        ]);
         SubCategory::create([
             'name' => 'Personal',
             'slug' => 'personal',
             'description' => '',
             'category_id' => $categoria->id
         ]);   
         $categoria2= Category::create([
            'name'      => 'Refresco',
            'slug'        => 'refresco',  
            'description' => 'Sabor y calidad',
            'image'      =>  null,
            'colour'       =>  null  
        ]);
        SubCategory::create([
            'name' => 'Jarra pequeña',
            'slug' => 'jarra_pequeña',
            'description' => '',
            'category_id' => $categoria2->id
        ]);
        $categoria3=Category::create([
            'name'      => 'Gaseosas',
            'slug'        => 'gaseosas',  
            'description' => 'Refresca tu mundo',
            'image'      =>  null,
            'colour'       =>  null      
        ]);
        SubCategory::create([
            'name' => 'Medio litro',
            'slug' => 'medio_litro',
            'description' => 'gaseosa de 500 ml',
            'category_id' => $categoria3->id
        ]);
        $categoria4=Category::create([
            'name'      => 'Cerveza',
            'slug'        => 'cerveza',  
            'description' => 'variedad en cervezas premium',
            'image'      =>  null,
            'colour'       =>  null  
        ]);  
        SubCategory::create([
            'name' => 'Prost',
            'slug' => 'prost',
            'description' => 'Cerveza prost',
            'category_id' => $categoria4->id
        ]);

    }
}
