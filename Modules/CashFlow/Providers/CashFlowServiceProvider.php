<?php

namespace Modules\CashFlow\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use TCG\Voyager\Facades\Voyager;

class CashFlowServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('CashFlow', 'Database/Migrations'));

        Voyager::addAction(\Modules\CashFlow\Actions\AllSeating::class);
        Voyager::addAction(\Modules\CashFlow\Actions\AllBox::class);
        Voyager::addAction(\Modules\CashFlow\Actions\ViewSeating::class);
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
            module_path('CashFlow', 'Config/config.php') => config_path('cashflow.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('CashFlow', 'Config/config.php'), 'cashflow'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/cashflow');

        $sourcePath = module_path('CashFlow', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/cashflow';
        }, \Config::get('view.paths')), [$sourcePath]), 'cashflow');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/cashflow');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'cashflow');
        } else {
            $this->loadTranslationsFrom(module_path('CashFlow', 'Resources/lang'), 'cashflow');
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
            app(Factory::class)->load(module_path('CashFlow', 'Database/factories'));
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
