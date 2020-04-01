<?php

namespace App\Providers;

use TCG\Voyager\Facades\Voyager;
use App\FormFields\Tracking;
use App\FormFields\Map;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(Tracking::class);
        Voyager::addFormField(Map::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addAction(\App\Actions\Roles::class);
        // Voyager::addAction(\App\Actions\Blocks::class);
        Voyager::addAction(\App\Actions\Pages::class);
        Voyager::addAction(\App\Actions\BlocksBread::class);
        Voyager::addAction(\App\Actions\PageEdit::class);
        Voyager::addAction(\App\Actions\Modules::class);
        // Voyager::addAction(\App\Actions\ModuleView::class);
        Voyager::addAction(\App\Actions\Users::class);
        Voyager::addAction(\App\Actions\Impersonate::class);
    }
}
