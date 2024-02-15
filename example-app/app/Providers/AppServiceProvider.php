<?php

namespace App\Providers;
use App\Helper\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
        view()->composer("*",function($view){
            $view->with([
                'cart'=>new Cart()
            ]);
        });


    }
}
