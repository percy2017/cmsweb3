<?php

namespace Modules\Streaming\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Page;
use App\Block;
class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $page = Page::create([
            'name'      => 'Page streaming',
            'slug'      => 'index',
            'direction' => 'streaming::index',
            'details'   => null
            
        ]);

        Block::create([
            'name'        => 'lpst_block1',
            'title'       => 'Blocke #1 (features #1)',
            'description' => 'Seccion Features #1 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Disfruta en tu TV.',
                    'width'  => 6
                ],
                'image' => [
                    'type'   => 'image',
                    'name'   => 'Imagen',
                    'label'  => 'Imagen del block1',
                    'value'  => 'default.png',
                    'width'  => 6
                ],

                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Ve en smart TV, PlayStation, Xbox, Chromecast, Apple TV, reproductores de Blu-ray y más..',
                    'width'  => 12
                ]
            ])
        ]);
    }
}
