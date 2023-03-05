<?php

namespace App\Providers;

use App\Models\CategoryMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
        View::composer('layouts.admin', function($view) {
            $categoryMenus = CategoryMenu::where(['status' => 1])->get();
        
            $view->with('categoryMenus', $categoryMenus);
        });
    }
}
