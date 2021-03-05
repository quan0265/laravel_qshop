<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use Cart;
use Auth;
use App\Models\Product;
use App\Models\Slider;



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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

        View::composer('frontend.layouts.sidebar',function($view){
            $product_new= Product::orderBy('id', 'desc')->limit(4)->get();
            $view->with('product_new', $product_new);
        });

        View::composer('frontend.layouts.master',function($view){
            
            if(Auth::guard('customer')->check()){
                $cart_count= Auth::guard('customer')->user()->cart->where('order_id', null)->sum('quanlity');
                $view->with('cart_count', $cart_count);
            }

            $sliders= Slider::where('status', 1)->limit(6)->orderBy('id', 'desc')->get();
            $view->with('sliders', $sliders);

        });




    }
}
