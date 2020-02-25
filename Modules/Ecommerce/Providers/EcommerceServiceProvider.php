<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use TCG\Voyager\Facades\Voyager;
class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Ecommerce', 'Database/Migrations'));

        Voyager::addAction(\Modules\Ecommerce\Actions\Details::class);
        Voyager::addAction(\Modules\Ecommerce\Actions\AllDetails::class);
        Voyager::addAction(\Modules\Ecommerce\Actions\AllCategories::class);
        Voyager::addAction(\Modules\Ecommerce\Actions\AllProducts::class);
        Voyager::addAction(\Modules\Ecommerce\Actions\AllProducts2::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Ecommerce', 'Config/config.php') => config_path('ecommerce.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Ecommerce', 'Config/config.php'), 'ecommerce'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/ecommerce');

        $sourcePath = module_path('Ecommerce', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/ecommerce';
        }, \Config::get('view.paths')), [$sourcePath]), 'ecommerce');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/ecommerce');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'ecommerce');
        } else {
            $this->loadTranslationsFrom(module_path('Ecommerce', 'Resources/lang'), 'ecommerce');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Ecommerce', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
