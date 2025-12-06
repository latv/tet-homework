<?php

namespace Tet\Products\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 1. Load Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // 2. Load Views
        // The second argument is the namespace you will use in blade files
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'products');
    }

    public function register()
    {
        // Bindings or config merging happen here
    }
}