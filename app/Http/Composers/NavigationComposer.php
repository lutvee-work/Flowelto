<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Products;

class NavigationComposer
{
    public function compose(View $view)
    {
        $products = Products::all();
        
        $view->with('categories', $products);
    }
}