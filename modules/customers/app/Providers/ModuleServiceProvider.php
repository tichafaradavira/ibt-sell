<?php

namespace Modules\Customers\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
//        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
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
            __DIR__.'/../../config/config.php' => config_path('customers.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../../config', 'customers'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/customers');

        $sourcePath = __DIR__.'/../../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom($sourcePath, 'customers');
    }

    /**
     * Register translations.
     *
     * @return void
     */


    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
//        if (! app()->environment('customerion') && $this->app->runningInConsole()) {
//            app(Factory::class)->load(module_path('CornerHub', 'Database/factories'));
//        }
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
