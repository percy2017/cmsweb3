<?php

namespace Modules\Streaming\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use TCG\Voyager\Facades\Voyager;
class StreamingServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Streaming', 'Database/Migrations'));

        Voyager::addAction(\Modules\Streaming\Actions\AllAccount::class);
        Voyager::addAction(\Modules\Streaming\Actions\AllAccount2::class);
        Voyager::addAction(\Modules\Streaming\Actions\AllMembership::class);
        Voyager::addAction(\Modules\Streaming\Actions\AllProfile::class);
        Voyager::addAction(\Modules\Streaming\Actions\Profiles::class);
        Voyager::addAction(\Modules\Streaming\Actions\HistoryProfiles::class);
        Voyager::addAction(\Modules\Streaming\Actions\AllBox::class);
        Voyager::addAction(\Modules\Streaming\Actions\AllSeating::class);
        Voyager::addAction(\Modules\Streaming\Actions\ViewSeating::class);
        Voyager::addAction(\Modules\Streaming\Actions\CreateBox::class);
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
            module_path('Streaming', 'Config/config.php') => config_path('streaming.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Streaming', 'Config/config.php'), 'streaming'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/streaming');

        $sourcePath = module_path('Streaming', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/streaming';
        }, \Config::get('view.paths')), [$sourcePath]), 'streaming');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/streaming');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'streaming');
        } else {
            $this->loadTranslationsFrom(module_path('Streaming', 'Resources/lang'), 'streaming');
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
            app(Factory::class)->load(module_path('Streaming', 'Database/factories'));
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
