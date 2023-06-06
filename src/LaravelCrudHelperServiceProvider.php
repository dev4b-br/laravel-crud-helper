<?php

namespace Dev4b\LaravelCrudHelper;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class LaravelCrudHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-crud-helper');
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
