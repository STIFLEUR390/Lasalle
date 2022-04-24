<?php

use App\Models\AppSetting;

if (!function_exists('currentRouteActive')) {
    function currentRouteActive(...$routes)
    {
        foreach ($routes as $route) {
            if(Route::currentRouteNamed($route)) return 'active';
        }
    }
}

if (!function_exists('currentChildActive')) {
    function currentChildActive($children)
    {
        foreach ($children as $child) {
            if(Route::currentRouteNamed($child['route'])) return 'active';
        }
    }
}

if (!function_exists('menuOpen')) {
    function menuOpen($children)
    {
        foreach ($children as $child) {
            if(Route::currentRouteNamed($child['route'])) return 'menu-open';
        }
    }
}

if (!function_exists('isRole')) {
    function isRole($role)
    {
        return auth()->user()->role === $role;
    }
}

if (!function_exists('appName')) {
    function appName()
    {
        if (Schema::hasTable('users')) {
            return AppSetting::find(1)->name;
        } else {
            return 'Dev Master';
        }
    }
}

if (!function_exists('activeFunction')) {
    function activeFunction(String $id)
    {
        if (Schema::hasTable('users')) {
            return AppSetting::find(1)->$id;
        } else {
            return 0;
        }
    }
}
