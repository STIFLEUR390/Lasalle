<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\{ Route, Schema, View };
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
        //
        Schema::defaultStringLength(125);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('app_settings') && AppSetting::find(1)->id) {
            View::share('app_setting', AppSetting::firstOrFail());
        }

        View::composer('layouts.base', function ($view) {
            $title = config('titles.' .
            Route::currentRouteName());
            $view->with(compact('title'));
        });
    }
}
