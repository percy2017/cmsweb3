<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Restaurant\Entities\Category;
use Modules\Restaurant\Entities\SubCategory;
use Modules\Restaurant\Entities\Supply;
use Modules\Restaurant\Entities\Extra;
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

        $categoria = Category::create([
            'name'      => 'Pizzas',
            'slug'        => 'pizzas',
            'description' => 'Sabor y calidad',
            'image'      =>  null
        ]);
            SubCategory::create([
                'name' => 'Personal',
                'slug' => 'personal',
                'description' => '',
                'category_id' => $categoria->id
            ]);   
            SubCategory::create([
                'name' => 'Mediana',
                'slug' => 'mediana',
                'description' => '',
                'category_id' => $categoria->id
            ]);  



         $categoria= Category::create([
            'name'      => 'Bebidas y Gaseosas',
            'slug'        => 'bebidas-gaseosas',  
            'description' => '',
            'image'      =>  null
        ]);
            SubCategory::create([
                'name' => 'Jarra pequeña',
                'slug' => 'jarra-pequeña',
                'description' => '',
                'category_id' => $categoria->id
            ]);
            SubCategory::create([
                'name' => 'Cocala Mini',
                'slug' => 'cocalola-mini',
                'description' => '',
                'category_id' => $categoria->id
            ]);


        $categoria=Category::create([
            'name'      => 'Bebidas Etilicas',
            'slug'        => 'cerveza',  
            'description' => 'variedad en cervezas premium',
            'image'      =>  null
        ]);  
            SubCategory::create([
                'name' => 'Paceña en la lata 800ml',
                'slug' => 'paceña-lata-800ml',
                'description' => '',
                'category_id' => $categoria->id
            ]);
            SubCategory::create([
                'name' => 'Prost',
                'slug' => 'prost',
                'description' => '',
                'category_id' => $categoria->id
            ]);

        //Insumos --------------------------------
        Supply::create([
            'name' => 'Harina',
            'unity' => 'Kilogramos',
            'price' => 6.9
        ]);        
        Supply::create([
            'name' => 'Sal',
            'unity' => 'Kilogramos',
            'price' => 3.6
        ]);        

        Supply::create([
            'name' => 'Azucar',
            'unity' => 'Kilogramos',
            'price' => 4.6
        ]);  



        //Extras --------------------------------
        Extra::create([
            'name' => 'Porcion de Papas',
            'price' => 7.9
        ]); 
        Extra::create([
            'name' => 'Porcion de Ticino',
            'price' => 4.9
        ]); 
        Extra::create([
            'name' => 'Porcion de Arroz',
            'price' => 2.9
        ]); 

        // factory(Modules\Restaurant\Entities\Product::class, 20)->create();
    }
}
