<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
        $menu = Menu::where('name', 'admin')->firstOrFail();
        
        $RestaurantMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Inventario',
            'url'     => '',
        ]);
        if (!$RestaurantMenuItem->exists) {
            $RestaurantMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-categories',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Productos',
            'url'     => '',
            'route'   => 'voyager.yimbo_products.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $RestaurantMenuItem->id,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Sucursales',
            'url'     => '',
            'route'   => 'voyager.yimbo_branch_offices.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-double-right',
                'color'      => null,
                'parent_id'  => $RestaurantMenuItem->id,
                'order'      => 1,
            ])->save();
        }


        // CRUD -----------------------------------------------------------
        Menu::firstOrCreate([
            'name' => 'yimbo_products',
        ]);
        $menu = Menu::where('name', 'yimbo_products')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Crear Nuevo',
            'url'     => 'admin/yimbo_products/create',
            'route'   => null
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => null,
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Listar',
            'url'     => 'admin/yimbo_products/1',
            'route'   => null
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => null,
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'divider',
            'url'     => null,
            'route'   => null
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => null,
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'setting',
            'url'     => null,
            'route'   => null
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_blank',
                'icon_class' => null,
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }



        

        Menu::firstOrCreate([
            'name' => 'yimbo_categories',
        ]);

        Menu::firstOrCreate([
            'name' => 'yimbo_sub_categories',
        ]);

        Menu::firstOrCreate([
            'name' => 'yimbo_branch_offices',
        ]);

        Menu::firstOrCreate([
            'name' => 'yimbo_supplies',
        ]);

        Menu::firstOrCreate([
            'name' => 'yimbo_extras',
        ]);
    }
}
