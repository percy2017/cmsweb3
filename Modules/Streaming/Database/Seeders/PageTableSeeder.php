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
            'details'   => json_encode([
                'carusel1_image' => [
                    'type' => 'image',
                    'name' => 'carusel1_image',
                    'label' => 'Imagen Header(2100x1464)',
                    'value' => '1.png',
                    'width' => 4
                ],
                'carusel2_image' => [
                    'type' => 'image',
                    'name' => 'carusel2_image',
                    'label' => 'Imagen Header(2100x1464)',
                    'value' => '2.png',
                    'width' => 4
                ],
                'carusel3_image' => [
                    'type' => 'image',
                    'name' => 'carusel3_image',
                    'label' => 'Imagen Header(2100x1464)',
                    'value' => '3.png',
                    'width' => 4
                ],


                'carusel1_title' => [
                    'type' => 'text',
                    'name' => 'carusel1_title',
                    'label' => 'Titulo #1',
                    'value' => 'NETFLIX',
                    'width' => 4
                ],
                'carusel2_title' => [
                    'type' => 'text',
                    'name' => 'carusel2_title',
                    'label' => 'Titulo #2',
                    'value' => 'SPOTIFY',
                    'width' => 4
                ],
                'carusel3_title' => [
                    'type' => 'text',
                    'name' => 'carusel3_title',
                    'label' => 'Titulo #3',
                    'value' => 'DISNEY PLUS',
                    'width' => 4
                ],


                'carusel1_description' => [
                    'type' => 'text',
                    'name' => 'carusel1_description',
                    'label' => 'Descripcion #1',
                    'value' => 'Disfruta de Serie y Peliculas',
                    'width' => 4
                ],
                'carusel2_description' => [
                    'type' => 'text',
                    'name' => 'carusel2_description',
                    'label' => 'Descripcion #2',
                    'value' => 'Descarga toda la musica.',
                    'width' => 4
                ],
                'carusel3_description' => [
                    'type' => 'text',
                    'name' => 'carusel3_description',
                    'label' => 'Descripcion # 3',
                    'value' => 'Descarga toda la musica.',
                    'width' => 4
                ],

                'carusel1_text_button' => [
                    'type' => 'text',
                    'name' => 'carusel1_text_button',
                    'label' => 'Texto del Boton #1',
                    'value' => 'VER PLANES',
                    'width' => 4
                ],
                'carusel2_text_button' => [
                    'type' => 'text',
                    'name' => 'carusel2_text_button',
                    'label' => 'Texto del Boton #2',
                    'value' => 'VER PLANES',
                    'width' => 4
                ],
                'carusel3_text_button' => [
                    'type' => 'text',
                    'name' => 'carusel3_text_button',
                    'label' => 'Texto del Boton #3',
                    'value' => 'VER PLANES',
                    'width' => 4
                ],

                'carusel1_action' => [
                    'type'  => 'text',
                    'name'  => 'carusel1_action',
                    'label' => 'accion btn #1',
                    'value' => '#pricing',
                    'width'  => 4
                ],
                'carusel2_action' => [
                    'type'  => 'text',
                    'name'  => 'carusel2_action',
                    'label' => 'accion btn #2',
                    'value' => '#pricing',
                    'width'  => 4
                ],
                'carusel3_action' => [
                    'type'  => 'text',
                    'name'  => 'carusel3_action',
                    'label' => 'accion btn #3',
                    'value' => '#pricing',
                    'width'  => 4
                ]
            ])
            
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
                'image1' => [
                    'type'   => 'image',
                    'name'   => 'image1',
                    'label'  => 'Imagen del block1',
                    'value'  => 'default.png',
                    'width'  => 6
                ],

                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Ve en smart TV, PlayStation, Xbox, Chromecast, Apple TV, reproductores de Blu-ray y más. Descarga contenidos para ver donde vayas.
                    Disfruta offline tus películas y programas favoritos. Disfruta donde quieras.
                    Películas y programas ilimitados en tu teléfono, tablet, computadora y TV sin costo extra.',
                    'width'  => 12
                ]
            ])
        ]);
        
        Block::create([
            'name'        => 'lpst_block2',
            'title'       => 'Blocke #2 (Spotify #2)',
            'description' => 'Seccion Spotify #2 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 2,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => '¿Por qué ser Premium?',
                    'width'  => 6
                ],

                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Escucha música sin límites
                    Reproduce millones de canciones sin anuncios, sin conexión y on-demand.',
                    'width'  => 6
                ],

                'icons1' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons1',
                    'label' => 'Icon #1',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title1' => [
                    'type'  => 'text',
                    'name'  => 'title1',
                    'label' => 'titulo 1',
                    'value' => 'Descarga tu música.',
                    'width'  => 3
                ],

                'decription1' => [
                    'type'  => 'text_area',
                    'name'  => 'decription1',
                    'label' => 'descripcion # 1 ',
                    'value' => 'Escúchala desde cualquier lugar.',
                    'width'  => 6
                ],

                'icons2' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons2',
                    'label' => 'Icon #2',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title2' => [
                    'type'  => 'text',
                    'name'  => 'title2',
                    'label' => 'titulo 2',
                    'value' => 'Sin anuncios que interrumpan tu música.',
                    'width'  => 3
                ],

                'decription2' => [
                    'type'  => 'text_area',
                    'name'  => 'decription2',
                    'label' => 'descripcion # 2 ',
                    'value' => 'Disfruta de tu música sin interrupciones',
                    'width'  => 6
                ],

                'icons3' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons3',
                    'label' => 'Icon #3',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title3' => [
                    'type'  => 'text',
                    'name'  => 'title3',
                    'label' => 'titulo 3',
                    'value' => 'Reproduce lo que quieras.',
                    'width'  => 3
                ],

                'decription3' => [
                    'type'  => 'text_area',
                    'name'  => 'decription3',
                    'label' => 'descripcion # 3',
                    'value' => 'Incluso en dispositivos móviles.',
                    'width'  => 6
                ],

                'icons4' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons4',
                    'label' => 'Icon #4',
                    'value' => 'fas fa-cogs blue-text',
                    'width'  => 3
                ],

                'title4' => [
                    'type'  => 'text',
                    'name'  => 'title4',
                    'label' => 'titulo 4',
                    'value' => 'Salta canciones de forma ilimitada.',
                    'width'  => 3
                ],

                'decription4' => [
                    'type'  => 'text_area',
                    'name'  => 'decription4',
                    'label' => 'descripcion # 4',
                    'value' => 'Salta canciones de forma ilimitada.',
                    'width'  => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lpst_block3',
            'title'       => 'Blocke #3 (Pasarela de Pago #3)',
            'description' => 'Seccion Pasarela de Pago #3 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 3,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Pasarela de Pago',
                    'width'  => 6
                ],
                'description'=> [
                    'type'   => 'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion',
                    'value'  => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quam sapiente
                    molestiae',
                    'width'  => 6
                ],

                'image11'=> [
                    'type'   => 'image',
                    'name'   => 'image11',
                    'label'  => 'Imagen #1',
                    'value'  => 'default1.png',
                    'width'  => 4
                ],
                'image22'=> [
                    'type'   => 'image',
                    'name'   => 'image22',
                    'label'  => 'Imagen #2',
                    'value'  => 'default2.png',
                    'width'  => 4
                ],
                'image33'=> [
                    'type'   => 'image',
                    'name'   => 'image33',
                    'label'  => 'Imagen #3',
                    'value'  => 'default3.png',
                    'width'  => 4
                ],

                'title1' => [
                    'type'   => 'text',
                    'name'   => 'title1',
                    'label'  => 'Titulo #1',
                    'value'  => 'Tigo Money',
                    'width'  => 4
                ],
                'title2' => [
                    'type'   => 'text',
                    'name'   => 'title2',
                    'label'  => 'Titulo #2',
                    'value'  => 'Banco BNB',
                    'width'  => 4
                ],
                 'title3' => [
                    'type'   => 'text',
                    'name'   => 'title3',
                    'label'  => 'Titulo #3',
                    'value'  => 'Banco Union',
                    'width'  => 4
                ],

                'account1' => [
                    'type'   => 'text',
                    'name'   => 'account1',
                    'label'  => 'Cuenta #1',
                    'value'  => 'Nro de Telefono: 78746621',
                    'width'  => 4
                ],
                'account2' => [
                    'type'   => 'text',
                    'name'   => 'account2',
                    'label'  => 'Cuenta #2',
                    'value'  => 'Nro de Cuenta: 8500183080',
                    'width'  => 4
                ],
                'account3' => [
                    'type'   => 'text',
                    'name'   => 'account3',
                    'label'  => 'Cuenta #3',
                    'value'  => 'Nro de Cuenta: 10000013879305',
                    'width'  => 4
                ]
                
            ])    
        ]);

        Block::create([
            'name'        => 'lpst_block4',
            'title'       => 'Blocke #4 (Pricing #4)',
            'description' => 'Seccion Peicing #4 para la plantilla LPST',
            'page_id'     => $page->id,
            'position'    => 4,
            'details'     => json_encode([
                'title' => [
                    'type'   => 'text',
                    'name'   => 'title',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Elige tu plan Premium.',
                    'width'  => 6
                ],
                'description' => [
                    'type'   => 'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion Corta',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam
                    eum porro a pariatur veniam.',
                    'width'  => 6
                ],

                'pricing1_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_title',
                    'label'  => 'Titulo #1',
                    'value'  => 'Netlix Premiun',
                    'width'  => 6
                ],
                'pricing1_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing1_price',
                    'label'  => 'Precio #1',
                    'value'  => '40',
                    'width'  => 6,
                    'step'   => '0,1',
                    'max'    => '190',
                    'min'    => '1'
                ],
                'pricing1_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description1',
                    'label'  => 'detalles del plan # 1',
                    'value'  => 'Ve Netflix en tu smartphone',
                    'width'  => 3
                ],
                'pricing1_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description2',
                    'label'  => 'detalles del plan # 1',
                    'value'  => ' tablet, smart TV, laptop ',
                    'width'  => 3
                ],
                'pricing1_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_description3',
                    'label'  => 'detalles del plan # 1',
                    'value'  => 'o dispositivo de streaming, ',
                    'width'  => 3
                ],
                'pricing1_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing1_button4',
                    'label'  => 'Acion del Boton # 1',
                    'value'  => '#pasarela',
                    'width'  => 3
                ],

                'pricing2_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_title',
                    'label'  => 'Titulo #2',
                    'value'  => 'Spotify Premiun',
                    'width'  => 6
                ],
                'pricing2_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing2_price',
                    'label'  => 'Precio #2',
                    'value'  => '20',
                    'width'  => 6
                ],
                'pricing2_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description1',
                    'label'  => 'detalles del plan # 2',
                    'value'  => 'Escucha música sin anuncios',
                    'width'  => 3
                ],
                'pricing2_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description2',
                    'label'  => 'detalles del plan # 2',
                    'value'  => 'Reproduce tus canciones en cualquier lugar, incluso sin conexión',
                    'width'  => 3
                ],
                'pricing2_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_description3',
                    'label'  => 'detalles del plan # 2',
                    'value'  => 'Reproducción on-demand',
                    'width'  => 3
                ],
                'pricing2_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing2_button4',
                    'label'  => 'Acion del Boton # 2',
                    'value'  => '#pasarela',
                    'width'  => 3
                ],

                'pricing3_title' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_title',
                    'label'  => 'Titulo #3',
                    'value'  => 'Disney Plus Premiun',
                    'width'  => 6
                ],
                'pricing3_price' => [
                    'type'   => 'number',
                    'name'   => 'pricing3_price',
                    'label'  => 'Precio #3',
                    'value'  => '100',
                    'width'  => 6
                ],
                'pricing3_description1' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description1',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' project',
                    'width'  => 3
                ],
                'pricing3_description2' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description2',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' components',
                    'width'  => 3
                ],
                'pricing3_description3' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_description3',
                    'label'  => 'detalles del plan # 3',
                    'value'  => ' features',
                    'width'  => 3
                ],
                'pricing3_button4' => [
                    'type'   => 'text',
                    'name'   => 'pricing3_button4',
                    'label'  => 'Acion del Boton # 3',
                    'value'  => '#',
                    'width'  => 3
                ]
 
            ])    
        ]);
    }
}
