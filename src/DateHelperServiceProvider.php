<?php

namespace UzzairWebstudio\DateHelper;

use Illuminate\Support\ServiceProvider;

class DateHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(DateHelper::class, function () {
            return new DateHelper();
        });
        $this->app->alias(DateHelper::class, 'date-helper');
    }
}
