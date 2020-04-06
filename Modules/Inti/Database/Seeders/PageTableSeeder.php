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
        Model::unguard();


        // $this->call("OthersTableSeeder");

        $page = Page::create([
            'name'      => 'Landing Page Inti',
            'slug'      => 'index',
            'direction' => 'inti::index',
            'description' => 'Pagina de destino para educacion en linea.',
            'details'   => null
        ]);
    }
}
