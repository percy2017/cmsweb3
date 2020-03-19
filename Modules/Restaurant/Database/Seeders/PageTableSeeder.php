<?php

namespace Modules\Restaurant\Database\Seeders;

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
        // Model::unguard();

        $page = Page::create([
            'name'      => 'Landing Page Restaurant',
            'slug'      => 'index',
            'direction' => 'restaurant::index',
            'description' => 'Pagina de destino para restaurant y venta de comida de rapida.',
            'details'   => json_encode([
                'image_header' => [
                    'type' => 'image',
                    'name' => 'image_header',
                    'label' => 'Imagen Header(2100x1464)',
                    'value' => 'myimage.png',
                    'width' => 4
                ],
                'title_header' => [
                    'type' => 'text',
                    'name' => 'title_header',
                    'label' => 'Titulo',
                    'value' => 'YIMBO v1.0',
                    'width' => 4
                ],
                'description_header' => [
                    'type' => 'text_area',
                    'name' => 'description_header',
                    'label' => 'Descripcion',
                    'value' => 'Software inteligente para la administracion y gestion de restaurant y venta de comida rapida.',
                    'width' => 4
                ],
                'space1' => [
                    'type'  => 'space',
                    'name'  => 'space1',
                ],
                'text_button' => [
                    'type' => 'text',
                    'name' => 'text_button',
                    'label' => 'Texto del Boton',
                    'value' => 'Comprar con Delivery',
                    'width' => 4
                ],
                'link_button' => [
                    'type' => 'text',
                    'name' => 'link_button',
                    'label' => 'Linkk del Boton',
                    'value' => '#',
                    'width' => 4
                ],
                'icons1' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons1',
                    'label' => 'Icon #1',
                    'value' => 'far fa-calendar-alt mr-2',
                    'width'  => 4
                ],
            ])
        ]);

        Block::create([
            'name'        => 'lpr_block1',
            'title'       => 'Blocke #1 (about us)',
            'description' => 'Seccion about us para la plantilla LPR',
            'page_id' => $page->id,
            'position'    => 1,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'ABOUT US',
                    'width'  => 6
                ],
                'image1' => [
                    'type'  => 'image',
                    'name'  => 'image1',
                    'label' => 'Logo del Restaurant(800x445)',
                    'value' => 'default.png',
                    'width' => 6
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Default',
                    'value' => 'We make good food and friendly atmosphere',
                    'width' => 6
                ],
                'description1' => [
                    'type'   => 'text_area',
                    'name'   => 'description1',
                    'label'  => 'Descripcion #1',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa pariatur id nobis accusamus deleniti cumque hic laborum.',
                    'width'  => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpr_block2',
            'title'       => 'Blocke #2 (Streak)',
            'description' => 'Seccion Streak para la plantilla LPR',
            'page_id' => $page->id,
            'position'    => 2,
            'details'     => json_encode([
                'title_default' => [
                    'type'   => 'text',
                    'name'   => 'title_default',
                    'label'  => 'Titulo en default',
                    'value'  => 'Food for the body is not enough. There must be food for the soul.',
                    'width'  => 4
                ],
                'image2' => [
                    'type'  => 'image',
                    'name'  => 'image2',
                    'label' => 'image treak',
                    'value' => 'default.png',
                    'width'  => 4
                ],
                'title_normal' => [
                    'type'  => 'text',
                    'name'  => 'text_normal',
                    'label' => 'texto normal',
                    'value' => '~ Dorothy Day',
                    'width'  => 4
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpr_block3',
            'title'       => 'Blocke #3 (DISCOVER)',
            'description' => 'Seccion DISCOVER para la plantilla LPR',
            'page_id' => $page->id,
            'position'    => 3,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'DISCOVER OUR DELIGHTS',
                    'width'  => 4
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'All European cuisine in one place',
                    'width'  => 4
                ],
                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molstias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fug',
                    'width'  => 4
                ],
                'button' => [
                    'type'   => 'text',
                    'name'   => 'button',
                    'label'  => 'Accion  del Boton',
                    'value'  => '#menu',
                    'width'  => 4
                ],
                'button_title' => [
                    'type'   => 'text',
                    'name'   => 'button_title',
                    'label'  => 'Titulo del Boton',
                    'value'  => 'SEE FULL MENU',
                    'width'  => 4
                ],
                'image' => [
                    'type'   => 'image',
                    'name'   => 'image',
                    'label'  => 'imagen de la Sección',
                    'value'  => 'Defaulf.png',
                    'width'  => 4
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpr_block4',
            'title'       => 'Blocke #4 (OUR SPECIALS)',
            'description' => 'Seccion OUR SPECIALS para la plantilla LPR',
            'page_id' => $page->id,
            'position'    => 4,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'OUR SPECIALS',
                    'width'  => 6
                ],
                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique.',
                    'width'  => 6
                ],
                'card1_title' => [
                    'type'   => 'text',
                    'name'   => 'card1_title',
                    'label'  => 'card 1 titulo',
                    'value'  => 'Breakfast',
                    'width'  => 6
                ],
                'card1_image' => [
                    'type'   => 'image',
                    'name'   => 'card1_image',
                    'label'  => 'card 1 Imagen',
                    'value'  => 'default1.png',
                    'width'  => 6
                ],
                'card2_title' => [
                    'type'   => 'text',
                    'name'   => 'card2_title',
                    'label'  => 'card 2 titulo',
                    'value'  => 'Launches',
                    'width'  => 6
                ],
                'card2_image' => [
                    'type'   => 'image',
                    'name'   => 'card2_image',
                    'label'  => 'card 2 Imagen',
                    'value'  => 'default2.png',
                    'width'  => 6
                ],
                'card3_title' => [
                    'type'   => 'text',
                    'name'   => 'card3_title',
                    'label'  => 'card 3 titulo',
                    'value'  => 'Desserts',
                    'width'  => 6
                ],
                'card3_image' => [
                    'type'   => 'image',
                    'name'   => 'card3_image',
                    'label'  => 'card 3 Imagen',
                    'value'  => 'default3.png',
                    'width'  => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpr_block5',
            'title'       => 'Blocke #5 (Streak 2)',
            'description' => 'Seccion Streak 2 para la plantilla LPR',
            'page_id' => $page->id,
            'position'    => 5,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'GREAT PEOPLE TRUSTED OUR SERVICES',
                    'width'  => 6
                ],
                'image' => [
                    'type'  => 'image',
                    'name'  => 'image',
                    'label' => 'imagen de Fondo',
                    'value' => 'default.png',
                    'width'  => 6
                ],
                'services1_number' => [
                    'type'  => 'text',
                    'name'  => 'services1_number',
                    'label' => 'numero entero',
                    'value' => '+950',
                    'width'  => 3
                ],
                'services2_number' => [
                    'type'  => 'text',
                    'name'  => 'services2_number',
                    'label' => 'numero entero',
                    'value' => '+150',
                    'width'  => 3
                ],
                'services3_number' => [
                    'type'  => 'text',
                    'name'  => 'services3_number',
                    'label' => 'numero entero',
                    'value' => '+85',
                    'width'  => 3
                ],
                'services4_number' => [
                    'type'  => 'text',
                    'name'  => 'services4_number',
                    'label' => 'numero entero',
                    'value' => '+246',
                    'width'  => 3
                ],
                'services1_title'  => [
                    'type'   => 'text',
                    'name'   => 'services1_title',
                    'label'  => 'Titulo',
                    'value'  => 'Happy clients',
                    'width'  => 3
                ],
                'services2_title'  => [
                    'type'   => 'text',
                    'name'   => 'services2_title',
                    'label'  => 'Titulo',
                    'value'  => 'Projects completed',
                    'width'  => 3
                ],
                'services3_title'  => [
                    'type'   => 'text',
                    'name'   => 'services3_title',
                    'label'  => 'Titulo',
                    'value'  => 'Winning awards',
                    'width'  => 3
                ],
                'services4_title'  => [
                    'type'   => 'text',
                    'name'   => 'services4_title',
                    'label'  => 'Titulo',
                    'value'  => 'Cups of coffee',
                    'width'  => 3
                ]
                
                
            ])
        ]);
        

    }
}
