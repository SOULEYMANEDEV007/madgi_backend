<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;

if (!function_exists('getGuardedRoute')) {
    /**
     * Get the route name based on the current guard.
     *
     * @param string $route
     * @return string
     */
    function getGuardedRoute($route, $params = null)
    {
        $guard = str_contains(request()->url(), 'admin') ? 'admin' : 'user';

        if($params != null) return route($guard . '.' . $route, $params);
        else return route($guard . '.' . $route);
    }
}
