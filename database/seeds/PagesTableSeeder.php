<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Page;
use App\Block;
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Landing Page Software ---------------
        // --------------------------
        $page = Page::create([
            'name'      => 'Landing Page Software',
            'slug'      => 'welcome',
            'direction' => 'welcome',
            'description' => 'Pagina de Destino para Empresa de Software',
            'details'   => json_encode([
                'title' => [
                    'type' => 'text',
                    'name' => 'title',
                    'label' => 'Titulo',
                    'value' => 'Make purchases with our app',
                    'width' => 6
                ],
                'image1' => [
                    'type' => 'image',
                    'name' => 'image1',
                    'label' => 'Imagen (600x670)',
                    'value' => 'myimage.png',
                    'width' => 6
                ],
                'button_text1' => [
                    'type' => 'text',
                    'name' => 'button_text1',
                    'label' => 'Texto Boton #1',
                    'value' => 'DOWNLOAD',
                    'width' => 6
                ],
                'button_link1' => [
                    'type' => 'text',
                    'name' => 'button_link1',
                    'label' => 'Link Text #1',
                    'value' => '#',
                    'width' => 6
                ],
                'button_text2' => [
                    'type' => 'text',
                    'name' => 'button_text2',
                    'label' => 'Texto Boton #2',
                    'value' => 'LEAR MORE',
                    'width' => 6
                ],
                'button_link2' => [
                    'type' => 'text',
                    'name' => 'button_link2',
                    'label' => 'Link Text #2',
                    'value' => '#',
                    'width' => 6
                ],
                
                'description' => [
                    'type' => 'text_area',
                    'name' => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem repellendus quasi fuga nesciunt dolorum nulla magnam veniam sapiente, fugiat! Commodi sequi non animi ea dolor molestiae iste.',
                    'width' => 12
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lps_block1',
            'title'       => 'Blocke #1 (features #1)',
            'description' => 'Seccion Features',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Lorem ipsum',
                    'width'  => 6
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'dolor sit amet',
                    'width'  => 6
                ],
                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Lorem ipsum dolor sit amet, consectetur dipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad voluptas, animi obcaecati adipisci sapiente mollitia.',
                    'width'  => 12
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
                    'label' => 'Title #1',
                    'value' => 'Customization',
                    'width'  => 3
                ],
                'descripcion1' => [
                    'type'  => 'text_area',
                    'name'  => 'description1',
                    'label' => 'Descripcion #1',
                    'value' => 'Lorem Ipsum is simply dummy text o the printing and typesetting let. Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'width' => 6
                ],
                'icons2' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons2',
                    'label' => 'Icon #2',
                    'value' => 'fas fa-book blue-text',
                    'width' => 3
                ],
                'title2' => [
                    'type'  => 'text',
                    'name'  => 'title2',
                    'label' => 'Title #2',
                    'value' => 'Easy tutorials',
                    'width' => 3
                ],
                'descripcion2' => [
                    'type'  => 'text_area',
                    'name'  => 'descripcion2',
                    'label' => 'Descripcion #2',
                    'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting le Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'width' => 6
                ],
                'icons3' => [
                    'type'  => 'select_dropdown',
                    'name'  => 'icons3',
                    'label' => 'Icon #3',
                    'value' => 'fas fa-users blue-text',
                    'width' => 3
                ],
                'title3' => [
                    'type'  => 'text',
                    'name'  => 'title3',
                    'label' => 'Title #3',
                    'value' => 'Easy tutorials',
                    'width' => 3
                ],
                'descripcion3' => [
                    'type'  => 'text_area',
                    'name'  => 'descripcion3',
                    'label' => 'Descripcion #3',
                    'value' => 'Lorem Ipsum is simply dummy text of the printing typesetting let. Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'width' => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lps_block2',
            'title'       => 'Blocke #2 (downlonad)',
            'description' => 'Seccion para Descargas',
            'page_id' => $page->id,
            'position'    => 2,
            'details'     => json_encode([
                'image_donwload' => [
                    'type'   => 'image',
                    'name'   => 'image_donwload',
                    'label'  => 'Image Donwload (900x572)',
                    'value'  => 'defualt.png',
                    'width'  => 4
                ],
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Lorem ipsum',
                    'width'  => 4
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'dolor sit amet',
                    'width'  => 4
                ],
                'desription' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting let. Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'width'  => 12
                ],
                'button1' => [
                    'type'  => 'text',
                    'name'  => 'button1',
                    'label' => 'Texto del Boton Android',
                    'value' => 'PLAY STORE',
                    'width'  => 6
                ],
                'button2' => [
                    'type'  => 'text',
                    'name'  => 'button2',
                    'label' => 'Texto del Boton Apple',
                    'value' => 'APP STORE',
                    'width'  => 6
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lps_block3',
            'title'       => 'Blocke #3 (features #2)',
            'description' => 'Seccion Features #2',
            'page_id' => $page->id,
            'position'    => 3,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Lorem ipsum',
                    'width'  => 4
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'dolor sit amet',
                    'width'  => 4
                ],
                'image_principal' => [
                    'type'   => 'image',
                    'name'   => 'image_principal',
                    'label'  => 'Image Princiapal,',
                    'value'  => 'default.png',
                    'width'  => 4
                ],
                'icons1' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons1',
                    'label'  => 'Icons #1',
                    'value'  => 'fas fa-tablet-alt blue-text',
                    'width'  => 4
                ],
                'title1' => [
                    'type'   => 'text',
                    'name'   => 'title1',
                    'label'  => 'Titulo #1',
                    'value'  => 'Fully responsive',
                    'width'  => 4
                ],
                'description1' => [
                    'type'   => 'text_area',
                    'name'   => 'description1',
                    'label'  => 'Descripcion #1',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores',
                    'width'  => 4
                ],
                'icons2' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons2',
                    'label'  => 'Icons #2',
                    'value'  => 'fas fa-level-up-alt blue-text',
                    'width'  => 4
                ],
                'title2' => [
                    'type'   => 'text',
                    'name'   => 'title2',
                    'label'  => 'Titulo #2',
                    'value'  => 'Frequent updates',
                    'width'  => 4
                ],
                'description2' => [
                    'type'   => 'text_area',
                    'name'   => 'description2',
                    'label'  => 'Descripcion #2',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetu adipisicing elit. Reprehenderit maiores',
                    'width'  => 4
                ],
                'icons3' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons3',
                    'label'  => 'Icons #3',
                    'value'  => 'fas fa-phone blue-text',
                    'width'  => 4
                ],
                'title3' => [
                    'type'   => 'text',
                    'name'   => 'title3',
                    'label'  => 'Titulo #3',
                    'value'  => 'Technical support',
                    'width'  => 4
                ],
                'description3' => [
                    'type'   => 'text_area',
                    'name'   => 'description3',
                    'label'  => 'Descripcion #3',
                    'value'  => 'Lorem ipsum dolr sit amet, consectetu adipisicing elit. Reprehderit maiores',
                    'width'  => 4
                ],
                'icons4' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons4',
                    'label'  => 'Icons #4',
                    'value'  => 'far fa-object-group blue-text',
                    'width'  => 4
                ],
                'title4' => [
                    'type'   => 'text',
                    'name'   => 'title4',
                    'label'  => 'Titulo #4',
                    'value'  => 'Editable layout',
                    'width'  => 4
                ],
                'description4' => [
                    'type'   => 'text_area',
                    'name'   => 'description4',
                    'label'  => 'Descripcion #4',
                    'value'  => 'Lorem ipsum dolr sit amet, conectetu adipisicing elit. Reprehderit maiores',
                    'width'  => 4
                ],
                'icons5' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons5',
                    'label'  => 'Icons #5',
                    'value'  => 'fas fa-rocket blue-text',
                    'width'  => 4
                ],
                'title5' => [
                    'type'   => 'text',
                    'name'   => 'title5',
                    'label'  => 'Titulo #5',
                    'value'  => 'Fast and powerful',
                    'width'  => 4
                ],
                'description5' => [
                    'type'   => 'text_area',
                    'name'   => 'description5',
                    'label'  => 'Descripcion #5',
                    'value'  => 'Lorem ipsum dolr sit amet, conectetu adipisicing elit. Reprehderit maioress.',
                    'width'  => 4
                ],
                'icons6' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons6',
                    'label'  => 'Icons #6',
                    'value'  => 'fas fa-cloud-upload-alt blue-text',
                    'width'  => 4
                ],
                'title6' => [
                    'type'   => 'text',
                    'name'   => 'title6',
                    'label'  => 'Titulo #6',
                    'value'  => 'Fast and powerful',
                    'width'  => 4
                ],
                'description6' => [
                    'type'   => 'text_area',
                    'name'   => 'description6',
                    'label'  => 'Descripcion #6',
                    'value'  => 'Lorem isum dolr sit amet, conectetu adipisicing elit. Reprehderit maioress.',
                    'width'  => 4
                ],
            ])
        ]);

        Block::create([
            'name'        => 'lps_block4',
            'title'       => 'Blocke #4 (Precios)',
            'description' => 'Seccion para Precios',
            'page_id' => $page->id,
            'position'    => 4,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Lorem ipsum',
                    'width'  => 4
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'dolor sit amet',
                    'width'  => 4
                ],
                'description' => [
                    'type'  => 'text_area',
                    'name'  => 'description',
                    'label' => 'Descripcion',
                    'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam',
                    'width'  => 4
                ],
                'icons1' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons1',
                    'label'  => 'Icons #1',
                    'value'  => 'fas fa-home blue-text',
                    'width'  => 2
                ],
                'title1' => [
                    'type'   => 'text',
                    'name'   => 'title1',
                    'label'  => 'Titulo #1',
                    'value'  => 'Basic plan',
                    'width'  => 2
                ],
                'price1' => [
                    'type'   => 'text',
                    'name'   => 'price1',
                    'label'  => 'Precio #1',
                    'value'  => '59 $',
                    'width'  => 2
                ],
                'button1' => [
                    'type'   => 'text',
                    'name'   => 'button1',
                    'label'  => 'Accion del Boton #1',
                    'value'  => '#',
                    'width'  => 2
                ],
                'description1' => [
                    'type'   => 'text_area',
                    'name'   => 'description1',
                    'label'  => 'Descripcion #1',
                    'value'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa pariatur id nobis accusamus deleniti cumque hic laborum.',
                    'width'  => 4
                ],
                'icons2' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons2',
                    'label'  => 'Icons #2',
                    'value'  => 'fas fa-users white-text',
                    'width'  => 2
                ],
                'title2' => [
                    'type'   => 'text',
                    'name'   => 'title2',
                    'label'  => 'Titulo #2',
                    'value'  => 'Premium plan',
                    'width'  => 2
                ],
                'price2' => [
                    'type'   => 'text',
                    'name'   => 'price2',
                    'label'  => 'Precio #2',
                    'value'  => '79 $',
                    'width'  => 2
                ],
                'button2' => [
                    'type'   => 'text',
                    'name'   => 'button2',
                    'label'  => 'Accion del Boton #2',
                    'value'  => '#',
                    'width'  => 2
                ],
                'description2' => [
                    'type'   => 'text_area',
                    'name'   => 'description2',
                    'label'  => 'Descripcion #2',
                    'value'  => 'Lorem ipsum dol sit amet, consectetur adipisicing elit. Culpa pariatur id nobis accusamus deleniti cumque hic laborum.',
                    'width'  => 4
                ],
                'icons3' => [
                    'type'   => 'select_dropdown',
                    'name'   => 'icons3',
                    'label'  => 'Icons #3',
                    'value'  => 'fas fa-chart-bar blue-text',
                    'width'  => 2
                ],
                'title3' => [
                    'type'   => 'text',
                    'name'   => 'title3',
                    'label'  => 'Titulo #3',
                    'value'  => 'Advanced plan',
                    'width'  => 2
                ],
                'price3' => [
                    'type'   => 'text',
                    'name'   => 'price3',
                    'label'  => 'Precio #3',
                    'value'  => '99 $',
                    'width'  => 2
                ],
                'button3' => [
                    'type'   => 'text',
                    'name'   => 'button2',
                    'label'  => 'Accion del Boton #3',
                    'value'  => '#',
                    'width'  => 2
                ],
                'description3' => [
                    'type'   => 'text_area',
                    'name'   => 'description3',
                    'label'  => 'Descripcion #3',
                    'value'  => 'Loem ipsum dol sit amet, consectetur adipisicing elit. Culpa pariatur id nobis accusamus deleniti cumque hic laborum.',
                    'width'  => 4
                ]
            ])
        ]);

        Block::create([
            'name'        => 'lps_block5',
            'title'       => 'Blocke #5 (Clientes)',
            'description' => 'Seccion Clientes',
            'page_id' => $page->id,
            'position'    => 5,
            'details'     => json_encode([
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Our clients',
                    'width'  => 6
                ],
                'title_default' => [
                    'type'  => 'text',
                    'name'  => 'title_default',
                    'label' => 'Titulo Normal',
                    'value' => 'about us',
                    'width'  => 6
                ],
                'image1' => [
                    'type'  => 'image',
                    'name'  => 'image1',
                    'label' => 'Imagen #1 (250x250)',
                    'value' => 'image1.png',
                    'width'  => 3
                ],
                'title1' => [
                    'type'  => 'text',
                    'name'  => 'title1',
                    'label' => 'Titulo #1',
                    'value' => 'Blake Dabney',
                    'width'  => 2
                ],
                'tag1' => [
                    'type'  => 'text',
                    'name'  => 'tag1',
                    'label' => 'Tag #1',
                    'value' => 'Web Designer',
                    'width'  => 2
                ],
                'description1' => [
                    'type'  => 'text_area',
                    'name'  => 'description1',
                    'label' => 'Descripcion #1',
                    'value' => 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis laboriosam.',
                    'width'  => 5
                ],
                'space1' => [
                    'type'  => 'space',
                    'name'  => 'space1',
                ],
                'image2' => [
                    'type'  => 'image',
                    'name'  => 'image2',
                    'label' => 'Imagen #2 (250x250)',
                    'value' => 'image2.png',
                    'width'  => 3
                ],
                'title2' => [
                    'type'  => 'text',
                    'name'  => 'title2',
                    'label' => 'Titulo #2',
                    'value' => 'Andrea Clay',
                    'width'  => 2
                ],
                'tag2' => [
                    'type'  => 'text',
                    'name'  => 'tag2',
                    'label' => 'Tag #2',
                    'value' => 'Front-end developer',
                    'width'  => 2
                ],
                'description2' => [
                    'type'  => 'text_area',
                    'name'  => 'description2',
                    'label' => 'Descripcion #2',
                    'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae.',
                    'width'  => 5
                ],
                'space2' => [
                    'type'  => 'space',
                    'name'  => 'space2',
                ],
                'image3' => [
                    'type'  => 'image',
                    'name'  => 'image3',
                    'label' => 'Imagen #3 (250x250)',
                    'value' => 'image3.png',
                    'width'  => 3
                ],
                'title3' => [
                    'type'  => 'text',
                    'name'  => 'title3',
                    'label' => 'Titulo #3',
                    'value' => 'Cami Gosse',
                    'width'  => 2
                ],
                'tag3' => [
                    'type'  => 'text',
                    'name'  => 'tag3',
                    'label' => 'Tag #3',
                    'value' => 'Phtographer',
                    'width'  => 2
                ],
                'description3' => [
                    'type'  => 'text_area',
                    'name'  => 'description3',
                    'label' => 'Descripcion #3',
                    'value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.',
                    'width'  => 5
                ],
                'space3' => [
                    'type'  => 'space',
                    'name'  => 'space3',
                ],
                'image4' => [
                    'type'  => 'image',
                    'name'  => 'image4',
                    'label' => 'Imagen #4 (250x250)',
                    'value' => 'image4.png',
                    'width'  => 3
                ],
                'title4' => [
                    'type'  => 'text',
                    'name'  => 'title4',
                    'label' => 'Titulo #4',
                    'value' => 'Bobby Haley',
                    'width'  => 2
                ],
                'tag4' => [
                    'type'  => 'text',
                    'name'  => 'tag4',
                    'label' => 'Tag #4',
                    'value' => 'Web Developer',
                    'width'  => 2
                ],
                'description4' => [
                    'type'  => 'text_area',
                    'name'  => 'description4',
                    'label' => 'Descripcion #4',
                    'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae.',
                    'width'  => 5
                ],
                'space4' => [
                    'type'  => 'space',
                    'name'  => 'space4',
                ],
                'image5' => [
                    'type'  => 'image',
                    'name'  => 'image5',
                    'label' => 'Imagen #5 (250x250)',
                    'value' => 'image5.png',
                    'width'  => 3
                ],
                'title5' => [
                    'type'  => 'text',
                    'name'  => 'title5',
                    'label' => 'Titulo #5 (250x250)',
                    'value' => 'Elisa Janson',
                    'width'  => 2
                ],
                'tag5' => [
                    'type'  => 'text',
                    'name'  => 'tag5',
                    'label' => 'Tag #5',
                    'value' => 'Marketer',
                    'width'  => 2
                ],
                'description5' => [
                    'type'  => 'text_area',
                    'name'  => 'description5',
                    'label' => 'Descripcion #5',
                    'value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.',
                    'width'  => 5
                ],
                'space5' => [
                    'type'  => 'space',
                    'name'  => 'space5',
                ],
                'image6' => [
                    'type'  => 'image',
                    'name'  => 'image6',
                    'label' => 'Imagen #6 (250x250)',
                    'value' => 'image6.png',
                    'width'  => 3
                ],
                'title6' => [
                    'type'  => 'text',
                    'name'  => 'title6',
                    'label' => 'Titulo #6',
                    'value' => 'Rob Jacobs',
                    'width'  => 2
                ],
                'tag6' => [
                    'type'  => 'text',
                    'name'  => 'tag6',
                    'label' => 'Tag #6',
                    'value' => 'Front-end developer',
                    'width'  => 2
                ],
                'description6' => [
                    'type'  => 'text_area',
                    'name'  => 'description6',
                    'label' => 'Descripcion #6',
                    'value' => 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis laboriosam.',
                    'width'  => 5
                ],
            ])
        ]);
        // Landng Page Software---------------------------------------------------------
    }
}
