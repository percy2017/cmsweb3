<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $count=1;

        $toolsMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.tools'),
            'url'     => '',
        ]);
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.users'),
            'url'     => '',
            'route'   => 'voyager.users.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => $count++,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Menus',
            'url'     => '',
            'route'   => 'voyager.menus.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-list',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => $count++,
            ])->save();
        }


        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu->id,
        //     'title'   => __('voyager::seeders.menu_items.compass'),
        //     'url'     => '',
        //     'route'   => 'voyager.compass.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-compass',
        //         'color'      => null,
        //         'parent_id'  => $toolsMenuItem->id,
        //         'order'      => 3,
        //     ])->save();
        // }

        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu->id,
        //     'title'   => __('voyager::seeders.menu_items.bread'),
        //     'url'     => '',
        //     'route'   => 'voyager.bread.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-bread',
        //         'color'      => null,
        //         'parent_id'  => $toolsMenuItem->id,
        //         'order'      => 4,
        //     ])->save();
        // }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.media'),
            'url'     => '',
            'route'   => 'voyager.media.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-images',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => $count++,
            ])->save();
        }
        
        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu->id,
        //     'title'   => __('voyager::seeders.menu_items.settings'),
        //     'url'     => '',
        //     'route'   => 'voyager.settings.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-settings',
        //         'color'      => null,
        //         'parent_id'  => $toolsMenuItem->id,
        //         'order'      => 5,
        //     ])->save();
        // }


        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Paginas',
            'url'     => '',
            'route'   => 'voyager.pages.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-paypal',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => $count++,
            ])->save();
        }

            // $menuItem = MenuItem::firstOrNew([
            //     'menu_id' => $menu->id,
            //     'title'   => 'Modulos',
            //     'url'     => '',
            //     'route'   => 'voyager.modules.index',
            // ]);
            // if (!$menuItem->exists) {
            //     $menuItem->fill([
            //         'target'     => '_self',
            //         'icon_class' => 'voyager-helm',
            //         'color'      => null,
            //         'parent_id'  => $toolsMenuItem->id,
            //         'order'      => 7,
            //     ])->save();
            // }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Notificaciones',
            'url'     => '',
            'route'   => 'voyager.notifications.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-sound',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => $count++,
            ])->save();
        }



        
        // ------------------- Menu Landing Page ----------------------------------------
        // -------------------------------------------------
        $menu = Menu::where('name', 'LandingPage')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Documentacion',
            'url'     => '/docs',
            'route'   => null,
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
            'title'   => 'Politicas y Privacidad',
            'url'     => '/politica-privacidad',
            'route'   => null,
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
            'title'   => 'Terminos y Condiciones',
            'url'     => '/terminos-condiones',
            'route'   => null,
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
        // ------------------- Menu Landing Page ----------------------------------------

        // Menu Social ----------------------------------------
        //----------------------------------------------------
        $menu = Menu::where('name', 'social')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'facebbok',
            'url'     => '#',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'fab fa-facebook-f',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'twitter',
            'url'     => '#',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'fab fa-twitter',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'instagram',
            'url'     => '#',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'fab fa-instagram',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }
        
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'linkedin',
            'url'     => '#',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'fab fa-linkedin-in white-text mr-lg-4',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 4,
            ])->save();
        }
        // Menu Social ----------------------------------------

    }


}
