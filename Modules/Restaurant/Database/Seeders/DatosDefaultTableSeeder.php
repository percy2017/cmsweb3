<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Restaurant\Entities\Category;
use Modules\Restaurant\Entities\SubCategory;
use Modules\Restaurant\Entities\Product;
use Modules\Restaurant\Entities\BranchOffice;
use Modules\Restaurant\Entities\Supply;

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
            'image'      =>  null,
            'colour'       =>  null
        ]);
        $subcategoria = SubCategory::create([
            'name' => 'Personal',
            'slug' => 'personal',
            'description' => '',
            'category_id' => $categoria->id
        ]);
        $categoria2 = Category::create([
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
        $categoria3 = Category::create([
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
        $categoria4 = Category::create([
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
        Product::create([
            'name' => 'Calabreza',
            'slug' => 'calabreza',
            'description_small' => 'salchica, jamom, etc',
            'price_sale' => 50,
            'stock' => 10,
            'category_id' => $categoria->id,
            'sub_category_id' => $subcategoria->id,
            'user_id' =>  1
        ]);
        BranchOffice::create([
            'name' => 'Casa Matris',
            'address' => 'Av. Bolivar',
            'phone' => '68967060',
            'whatsapp' => '68967060',
            'latitud' => '14.799924',
            'longitud' => '64.870184'

        ]);
        Supply::create([
            'name' => 'Pieza',
            'unity' => 10,
            'price' => 100,

        ]);
    }
}
