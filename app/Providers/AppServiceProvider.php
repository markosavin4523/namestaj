<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // 1. Obavezno uvezi ovo!
use App\Models\Category;

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
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {

            $categories = Category::where("active",true)->whereNull('parent_id')->with('children')->get();
            if (auth()->check()) {
                $likeCount = auth()->user()->likes()->count();
                $cartCount = auth()->user()->carts()->first() ?
                    auth()->user()->carts()->first()->products()->count()
                    : 0;
            } else {
                $cartCount = count(session()->get('cart', []));
                $likeCount = count(session()->get('guest_likes', []));
            }



            $view->with([
                'categories' => $categories,
                'likeCount' => $likeCount,
                'cartCount' => $cartCount
            ]);
        });

    }
}
