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

        $page = Page::create([
            'name'      => 'Landing Page Inti',
            'slug'      => 'index',
            'direction' => 'inti::index',
            'user_id' => 1,
            'description' => 'Pagina de destino para educacion en linea.',
            'details'   => null
        ]);
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
    }
}
