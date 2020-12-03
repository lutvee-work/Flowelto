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
            ['addFlower', 'cart', 'changePassword', 'detail', 'edit', 'editCategories', 'history', 'historyDetail', 'home', 'manageCategories', 'manager', 'product', 'search', 'welcome',],
            'App\Http\Composers\NavigationComposer'
        );
    }
}
