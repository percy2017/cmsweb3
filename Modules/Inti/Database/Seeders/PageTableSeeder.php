<?php

namespace Modules\Inti\Database\Seeders;
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
        /**------------------Landing Page -----------------------*/
         /**--------------------------------------------------*/

        $page = Page::create([
            'name'        =>  'Landing Page Inti',
            'slug'        =>  'landing-page-inti',
            'user_id'     =>  1,
            'direction'   =>  'inti::index',
            'description' =>  'Pagina de destino para educacion en linea.',
            'details'     =>   json_encode([
                    /** banner----- */
                    'title_h5' => [
                        'type'   => 'text',
                        'name'   => 'title_h5',
                        'label'  => 'Titulo h5 (banner)',
                        'value'  => 'Todos los Niños Anelan Aprender',
                        'width'  => 6
                    ],
                    'title_h1'=>[
                        'type'   => 'text',
                        'name'   => 'title_h1',
                        'label'  => 'Titulo h1 (banner)',
                        'value'  => 'Hacer Que El Mundo De Sus Hijos Sea Mejor',
                        'width'  => 6
                    ],
                    'btn_name1' => [
                        'type'   => 'text',
                        'name'   => 'btn_name1',
                        'label'  => 'Nombre del boton (banner)',
                        'value'  => 'Ver Cursos',
                        'width'  => 6
                    ],
                    'btn_action1' => [
                        'type'   => 'text',
                        'name'   => 'buton_action1',
                        'label'  => 'Accion del boton (banner)',
                        'value'  => '#',
                        'width'  => 6
                    ], 
                    'btn_name2' => [
                        'type'   => 'text',
                        'name'   => 'btn_name2',
                        'label'  => 'Nombre del boton (banner)',
                        'value'  => 'Empezar',
                        'width'  => 6
                    ],
                    'btn_action2' => [
                        'type'   => 'text',
                        'name'   => 'btn_action2',
                        'label'  => 'Accion del boton (banner)',
                        'value'  => '#',
                        'width'  => 6
                    ],
                    'parrafo' => [
                        'type'   => 'text_area',
                        'name'   => 'parrafo',
                        'label'  => 'Parrafo del Banner',
                        'value'  => 'Replenish seasons may male hath fruit beast were seas saw you arrie said man beast whales
                        his void unto last session for bite. Set have great youll male grass yielding yielding man',
                        'width'  => 12
                    ]

            ])
        ]);
        
         /** block 1 */              
        Block::create([
            'name'        => 'lpit_block1',
            'title'       => 'Blocke #1 (feature_part start #1)',
            'description' => 'Seccion Features #1 para la plantilla LPIT',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([

                /** single_feature_text */
                'title_strong' => [
                    'type'   => 'text',
                    'name'   => 'title_strong',
                    'label'  => 'Titulo en Negrita',
                    'value'  => 'Increible<br>Funciones',
                    'width'  => 6
                ],
                'description'=>[
                    'type'=>'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion',
                    'value'  => 'Set have great you male grass yielding an yielding first their you are
                    have called the abundantly fruit were man',
                    'width'  => 6
                ],
                'buton_name' => [
                    'type'   => 'text',
                    'name'   => 'buton_name',
                    'label'  => 'Nombre del boton',
                    'value'  => 'Leer más',
                    'width'  => 6
                ],
                'buton_action' => [
                    'type'   => 'text',
                    'name'   => 'buton_action',
                    'label'  => 'Accion del boton',
                    'value'  => '#',
                    'width'  => 6
                ], 
                
                /** single_feature  1 */
                'h4_1' => [
                    'type'   => 'text',
                    'name'   => 'h4_1',
                    'label'  => 'Titulo h4 #1',
                    'value'  => 'Mejor Futuro',
                    'width'  => 6
                ],
                'parrafo_1'=>[
                    'type'=>'text_area',
                    'name'   => 'parrafo_1',
                    'label'  => 'Parrafo #1',
                    'value'  => 'Set have great you male grasses yielding yielding first their to called deep abundantly Set have great you male',
                    'width'  => 6
                ],
                /** single_feature  2 */
                'h4_2' => [
                    'type'   => 'text',
                    'name'   => 'h4_2',
                    'label'  => 'Titulo h4 #2',
                    'value'  => 'Tutores Calificados',
                    'width'  => 6
                ],
                'parrafo_2'=>[
                    'type'=>'text_area',
                    'name'   => 'parrafo_2',
                    'label'  => 'Parrafo #2',
                    'value'  => 'Set have great you male grasses yielding yielding first their to called deep abundantly Set have great you male',
                    'width'  => 6
                ],
                /** single_feature  3 */
                'h4_3' => [
                    'type'   => 'text',
                    'name'   => 'h4_3',
                    'label'  => 'Titulo h4 #3',
                    'value'  => 'Oportunidad de trabajo',
                    'width'  => 6
                ],
                'parrafo_3'=>[
                    'type'=>'text_area',
                    'name'   => 'parrafo_3',
                    'label'  => 'Parrafo #3',
                    'value'  => 'Set have great you male grasses yielding yielding first their to called deep abundantly Set have great you male',
                    'width'  => 6
                ],
            ])
        ]);
        /** block 2 */          
        Block::create([
            'name'        => 'lpit_block2',
            'title'       => 'Blocke #2 (learning_member # 2)',
            'description' => 'Seccion learning_member # 2 para la plantilla LPIT',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([

                /** learning_member */
                'img'=>[
                    'type'   => 'image',
                    'name'   => 'img',
                    'label'  => 'Learnig image',
                    'value'  => 'learning_img.png',
                    'width'  => 6
                ],
                'title_h5' => [
                    'type'   => 'text',
                    'name'   => 'title_h5',
                    'label'  => 'Titulo h5',
                    'value'  => 'Sobre Nosotros',
                    'width'  => 6
                ],
                'title_h2' => [
                    'type'   => 'text',
                    'name'   => 'title_h2',
                    'label'  => 'Titulo h2',
                    'value'  => 'Aprender con amor y risas',
                    'width'  => 6
                ],
                'description'=>[
                    'type'=>'text_area',
                    'name'   => 'description',
                    'label'  => 'Descripcion',
                    'value'  => 'Fifth saying upon divide divide rule for deep their female all hath brind Days and beast
                    greater grass signs abundantly have greater also
                    days years under brought moveth.',
                    'width'  => 6
                ],
                'span1' => [
                    'type'   => 'text',
                    'name'   => 'span1',
                    'label'  => 'Texto del span 1',
                    'value'  => 'Him lights given i heaven second yielding seas
                    gathered wear',
                    'width'  => 6
                ],
                'span2' => [
                    'type'   => 'text',
                    'name'   => 'span2',
                    'label'  => 'Texto del span 1',
                    'value'  => 'Him lights given i heaven second yielding seas
                    gathered wear',
                    'width'  => 6
                ],
                'btn_name' => [
                    'type'   => 'text',
                    'name'   => 'btn_name',
                    'label'  => 'Nombre del boton',
                    'value'  => 'Leer Más',
                    'width'  => 6
                ],
                'btn_action'=>[
                    'type'=>'text',
                    'name'   => 'btn_action',
                    'label'  => 'Accion del boton',
                    'value'  => '#',
                    'width'  => 6
                ],
                
            ])
        ]);
        /** block 3 */          
        Block::create([
            'name'        => 'lpit_block3',
            'title'       => 'Blocke #3 (member_counter # 3)',
            'description' => 'Seccion member_counter # 3 para la plantilla LPIT',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([

                /** member_counter */
                'counter1'=>[
                    'type'   => 'text',
                    'name'   => 'counter1',
                    'label'  => 'Counter #1',
                    'value'  => '100',
                    'width'  => 6
                ],
                'title1' => [
                    'type'   => 'text',
                    'name'   => 'title1',
                    'label'  => 'Titulo h4 #1',
                    'value'  => 'Todos Los <br> Profesores',
                    'width'  => 6
                ],
                'counter2'=>[
                    'type'   => 'text',
                    'name'   => 'counter2',
                    'label'  => 'Counter #2',
                    'value'  => '200',
                    'width'  => 6
                ],
                'title2' => [
                    'type'   => 'text',
                    'name'   => 'title2',
                    'label'  => 'Titulo h4 #2',
                    'value'  => 'Todos Los <br> Estudiantes',
                    'width'  => 6
                ],
                'counter3'=>[
                    'type'   => 'text',
                    'name'   => 'counter3',
                    'label'  => 'Counter #3',
                    'value'  => '100',
                    'width'  => 6
                ],
                'title3' => [
                    'type'   => 'text',
                    'name'   => 'title3',
                    'label'  => 'Titulo h4 #3',
                    'value'  => 'Estudiantes <br>En Línea',
                    'width'  => 6
                ],
                'counter4'=>[
                    'type'   => 'text',
                    'name'   => 'counter4',
                    'label'  => 'Counter #4',
                    'value'  => '200',
                    'width'  => 6
                ],
                'title4' => [
                    'type'   => 'text',
                    'name'   => 'title4',
                    'label'  => 'Titulo h4 #4',
                    'value'  => 'Estudiantes<br> Ofline',
                    'width'  => 6
                ]
                
                
            ])
        ]);
        /** block 4 */   
        Block::create([
            'name'        => 'lpit_block4',
            'title'       => 'Blocke #4 (special_cource # 4)',
            'description' => 'Seccion special_cource # 4 para la plantilla LPIT',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([

                'title_p' => [
                    'type'   => 'text',
                    'name'   => 'title_p',
                    'label'  => 'Titulo ',
                    'value'  => 'Cursos Populares',
                    'width'  => 6
                ],
              
                'title_h2' => [
                    'type'   => 'text',
                    'name'   => 'title_h2',
                    'label'  => 'Titulo H2',
                    'value'  => 'Cursos Especiales',
                    'width'  => 6
                ],
              
              
              /** 
               * ----------------------------------------------
               * card 1
               * ----------------------------------------------
               */
              
                  'imagen_1' => [
                    'type'   => 'image',
                    'name'   => 'imagen_1',
                    'label'  => 'imagen  # 1 ',
                    'value'  => 'default1.png',
                    'width'  => 6
                ],

                'imagen_autor_1' => [
                    'type'   => 'image',
                    'name'   => 'imagen_autor_1',
                    'label'  => ' Imagen Autor #1 ',
                    'value'  => 'autor_1.png',
                    'width'  => 6
                ],/**fila #1  */
              
                'btn_1' => [
                    'type'   => 'text',
                    'name'   => 'btn_1',
                    'label'  => 'Titulo btn # 1',
                    'value'  => 'Desarrollo Web',
                    'width'  => 3
                ],
              
                'btn_action_1' => [
                    'type'   => 'text',
                    'name'   => 'btn_action_1',
                    'label'  => 'Accion del Btn #1',
                    'value'  => '#',
                    'width'  => 3
                ], 
                       
                'link_1' => [
                    'type'   => 'text',
                    'name'   => 'link_1',
                    'label'  => 'Titulo link #1 ',
                    'value'  => 'Desarrollo Web',
                    'width'  => 3
                ],
              
                'link_action_1' => [
                    'type'   => 'text',
                    'name'   => 'link_action_1',
                    'label'  => 'Accion del Link # 1 ',
                    'value'  => '#',
                    'width'  => 3
                ],/**fila #2 */
              
                'price_h4_1' => [
                    'type'   => 'text',
                    'name'   => 'price_h4_1',
                    'label'  => 'Precio #1 ',
                    'value'  => 'Bs 100.00',
                    'width'  => 4
                ],
              
                'title_p_1' => [
                    'type'   => 'text',
                    'name'   => 'title_p_1',
                    'label'  => 'Titulo p1 ',
                    'value'  => 'Dirigido Por:',
                    'width'  => 4
                ],
              
                'title_h5_1' => [
                    'type'   => 'text',
                    'name'   => 'title_h5_1',
                    'label'  => 'Nombre del Trainer #1',
                    'value'  => 'James_Well:',
                    'width'  => 4
                ],/**fila # 3 */

                'description_1' => [
                    'type'   => 'text_area',
                    'name'   => 'description_1',
                    'label'  => 'Descripcion del card #1',
                    'value'  => 'Que la oscuridad que decía era vida para los peces en donde todos los peces de juntos llamaban',
                    'width'  => 12
                ],
              
              
              /** 
               * ----------------------------------------------
               * card 2
               * ----------------------------------------------
               */
              
              
                'imagen_2' => [
                    'type'   => 'image',
                    'name'   => 'imagen_2',
                    'label'  => 'imagen 2 ',
                    'value'  => 'default2.png',
                    'width'  => 6
                ],
              
                'imagen_autor_2' => [
                    'type'   => 'image',
                    'name'   => 'imagen_autor_2',
                    'label'  => 'Autor ',
                    'value'  => 'Autor_2.png',
                    'width'  => 6
                ],/**fila # 1 */

                'btn_2' => [
                    'type'   => 'text',
                    'name'   => 'btn_2',
                    'label'  => 'Titulo btn ',
                    'value'  => 'Diseño',
                    'width'  => 3
                ],
              
                'btn_action_2' => [
                    'type'   => 'text',
                    'name'   => 'btn_action_2',
                    'label'  => 'Accion del Btn ',
                    'value'  => '#',
                    'width'  => 3
                ],
                       
                'link_2' => [
                    'type'   => 'text',
                    'name'   => 'link_2',
                    'label'  => 'Titulo btn link ',
                    'value'  => 'Diseño web UX/UI',
                    'width'  => 3
                ],
              
                'link_action_2' => [
                    'type'   => 'text',
                    'name'   => 'link_action_2',
                    'label'  => 'Accion del Btn ',
                    'value'  => '#',
                    'width'  => 3
                ],/**fila # 2 */
              
                'price_h4_2' => [
                    'type'   => 'text',
                    'name'   => 'price_h4_2',
                    'label'  => 'Precio ',
                    'value'  => 'Bs 160.00',
                    'width'  => 4
                ],
              
                'title_p_2' => [
                    'type'   => 'text',
                    'name'   => 'title_p_2',
                    'label'  => 'Titulo p2 ',
                    'value'  => 'Dirigido Por:',
                    'width'  => 4
                ],
              
                'title_h5_2' => [
                    'type'   => 'text',
                    'name'   => 'title_h5_2',
                    'label'  => 'Nombre ',
                    'value'  => 'James_Well:',
                    'width'  => 4
                ],/**fila # 3 */

                'description_2' => [
                    'type'   => 'text_area',
                    'name'   => 'description_2',
                    'label'  => 'Descripcion ',
                    'value'  => 'Que la oscuridad que decía era vida para los peces en donde todos los peces de juntos llamaban',
                    'width'  => 12
                ],

              
              /** 
               * ----------------------------------------------
               * card 3
               * ----------------------------------------------
               */
              
              
                'imagen_3' => [
                    'type'   => 'image',
                    'name'   => 'imagen_3',
                    'label'  => 'imagen 3 ',
                    'value'  => 'default3.png',
                    'width'  => 6
                ],

                'imagen_autor_3' => [
                    'type'   => 'image',
                    'name'   => 'imagen_autor_3',
                    'label'  => 'Autor ',
                    'value'  => 'Autor_3.png',
                    'width'  => 6
                ],/**fila # 1*/
              
                'btn_3' => [
                    'type'   => 'text',
                    'name'   => 'btn_3',
                    'label'  => 'Titulo btn ',
                    'value'  => 'Wordpress',
                    'width'  => 3
                ],
              
                'btn_action_3' => [
                    'type'   => 'text',
                    'name'   => 'btn_action_3',
                    'label'  => 'Accion del Btn ',
                    'value'  => '#',
                    'width'  => 3
                ],
                       
                'link_3' => [
                    'type'   => 'text',
                    'name'   => 'link_3',
                    'label'  => 'Titulo btn link ',
                    'value'  => 'Desarrollo de Wordpress',
                    'width'  => 3
                ],
              
                'link_action_3' => [
                    'type'   => 'text',
                    'name'   => 'link_action_3',
                    'label'  => 'Accion del Btn ',
                    'value'  => '#',
                    'width'  => 3
                ],/**fila # 2 */
              
                'price_h4_3' => [
                    'type'   => 'text',
                    'name'   => 'price_h4_3',
                    'label'  => 'Precio ',
                    'value'  => 'Bs 140.00',
                    'width'  => 4
                ],
              
                'title_p_3' => [
                    'type'   => 'text',
                    'name'   => 'title_p_3',
                    'label'  => 'Titulo p3 ',
                    'value'  => 'Dirigido Por:',
                    'width'  => 4
                ],
              
                'title_h5_3' => [
                    'type'   => 'text',
                    'name'   => 'title_h5_3',
                    'label'  => 'Nombre ',
                    'value'  => 'James_Well:',
                    'width'  => 4
                ],  /**fila # 3 */  

                'description_3' => [
                    'type'   => 'text_area',
                    'name'   => 'description_3',
                    'label'  => 'Descripcion ',
                    'value'  => 'Que la oscuridad que decía era vida para los peces en donde todos los peces de juntos llamaban',
                    'width'  => 12
                ],


            ])
        ]);        
        /** block 5 */           
        Block::create([
            'name'        => 'lpit_block5',
            'title'       => 'Blocke #5 (advance_feature # 5)',
            'description' => 'Seccion advance_feature # 5 para la plantilla LPIT',
            'page_id'     => $page->id,
            'position'    => 1,
            'details'     => json_encode([
                'title_h5' => [
                    'type'   => 'text',
                    'name'   => 'title_h5',
                    'label'  => 'Titulo h5 ',
                    'value'  => 'Función Avanzadas',
                    'width'  => 6
               ], 
              
               'title_h2' => [
                    'type'   => 'text',
                    'name'   => 'title_h2',
                    'label'  => 'Titulo h2',
                    'value'  => 'Nuestro sistema de aprendizaje avanzado para educadores',
                    'width'  => 6
               ],  
                
                'parrafo' => [
                    'type'   => 'text_area',
                    'name'   => 'parrafo',
                    'label'  => 'parrafo 1',
                    'value'  => 'Quinto dicho sobre la regla de dividir dividir para lo profundo de sus hembras, todo lo ha superado a mediados de los días y las bestias, los signos de hierba más abundantes también tienen un mayor uso sobre los días de la tierra de la cara años bajo los movimientos traídos, ella es la estrella',
                    'width'  => 12
                ],
              
                'title_h4' => [
                    'type'   => 'text',
                    'name'   => 'title_h4',
                    'label'  => 'Titulo h4',
                    'value'  => 'Aprende en cualquier lugar',
                    'width'  => 4
               ], 
              
                'parrafo_2' => [
                    'type'   => 'text',
                    'name'   => 'parrafo_2',
                    'label'  => 'Parrafo 2',
                    'value'  => 'Allí, la cara de la tierra, la tierra, he aquí, ella protagonizó, así que anuló dos dados y también nuestro',
                    'width'  => 8
              
                ],
              
                 'title_h4_1' => [
                    'type'   => 'text',
                    'name'   => 'title_h4_1',
                    'label'  => 'Titulo h4_1',
                    'value'  => 'Profesor experto',
                    'width'  => 4
                ], 
              
                'parrafo_3' => [
                    'type'   => 'text',
                    'name'   => 'parrafo_3',
                    'label'  => 'Parrafo 3',
                    'value'  => 'Allí, la cara de la tierra, la tierra, he aquí, ella protagonizó, así que anuló dos dados y también nuestro',
                    'width'  => 8
                ],
              
                'imagen' => [
                    'type'   => 'image',
                    'name'   => 'imagen',
                    'label'  => 'Imagen del bloque 5',
                    'value'  => 'img.png',
                    'width'  => 12
                ]
            ])
        ]);        
        /**------------------page live------------------------*/
         /**--------------------------------------------------*/
         
        // $page = Page::create([
        //     'name'        =>  'Page Live',
        //     'slug'        =>  'page-live',
        //     'user_id'     =>  1,
        //     'direction'   =>  'inti::pages.generica',
        //     'description' =>  'Pagina de destino para educacion en linea.',
        //     'details'     =>   json_encode([
        //         /** banner----- */
        //         'title_h2' => [
        //             'type'   => 'text',
        //             'name'   => 'title_h2',
        //             'label'  => 'Titulo H2',
        //             'value'  => 'slug page',
        //             'width'  => 4
        //         ],
        //         'p1' => [
        //             'type'   => 'text',
        //             'name'   => 'p1',
        //             'label'  => 'etiqueta p1',
        //             'value'  => 'Home',
        //             'width'  => 4
        //         ],
        //         'p2' => [
        //             'type'   => 'text',
        //             'name'   => 'p2',
        //             'label'  => 'etiqueta p2',
        //             'value'  => 'slug page',
        //             'width'  => 4
        //         ]

        //     ])
        // ]);  

        /** block 1 */              
        // Block::create([
        //     'name'        => 'live_block1',
        //     'title'       => 'Blocke #1 (seccion de cursos lives)',
        //     'description' => 'Seccion Lista de Cursos lives',
        //     'page_id'     => $page->id,
        //     'position'    => 1,
        //     'details'     => json_encode([

        //         /** single_feature_text */
        //         'card-img' => [
        //             'type'   => 'image',
        //             'name'   => 'card-img',
        //             'label'  => 'Imagen card',
        //             'value'  => 'default.png',
        //             'width'  => 4
        //         ],
        //         'month'=>[
        //             'type'=>'text',
        //             'name'   => 'month',
        //             'label'  => 'Mes ',
        //             'value'  => 'junio',
        //             'width'  => 4
        //         ],
        //         'day'=>[
        //             'type'=>'text',
        //             'name'   => 'day',
        //             'label'  => 'dia ',
        //             'value'  => '15',
        //             'width'  => 4
        //         ],
        //         'title_h2' => [
        //             'type'   => 'text',
        //             'name'   => 'title_h2',
        //             'label'  => 'Titulo H2',
        //             'value'  => 'Google inks pact for new 35-storey office',
        //             'width'  => 6
        //         ]
        //     ])
        // ]);        
    
    }
}
