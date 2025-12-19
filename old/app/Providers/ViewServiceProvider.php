<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $guard = auth()->guard(Admin::$guard)->check() ? 'admin.' : 'user.';
            $view->with('guard', $guard);
        });
    }
}
