<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer(
            ['addFlower', 'addCategories', 'cart', 'changePassword', 'detail', 'edit', 'editCategories', 'history', 'historyDetail', 'home', 'auth.login', 'manageCategories', 'manager', 'product', 'auth.register', 'search', 'welcome',],
            'App\Http\Composers\NavigationComposer'
        );
    }
}
