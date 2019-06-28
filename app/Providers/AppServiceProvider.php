<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
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
        Schema::defaultStringLength(191);
        // create cache contain category
        view()->composer('*',function($view){
            // $categories = \Cache::remember('categories', function () {
            //     return Category::all();
            // });
            $categories=Category::all();
            // // dd($categories);
            // $category = Category::latest()->paginate(10);

            $view->with('categories',$categories);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \URL::forceScheme('https');
        //

    }
}
