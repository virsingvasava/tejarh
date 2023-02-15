<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menus;
use App\Models\Category;

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

        //Fetch footer menu in Backend
        view()->composer(['frontend.partials.footer'], function ($view)
        {
            $sitelinksMenu = Menus::where('type', SITE_LINKS)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
            $popularcitiesMenu = Menus::where('type', POPULAR_CITIES)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
            $usefullinksMenu = Menus::where('type', USEFUL_LINKS)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
            $view->with('sitelinksMenu', $sitelinksMenu)
            ->with('popularcitiesMenu', $popularcitiesMenu)
            ->with('usefullinksMenu', $usefullinksMenu);
        });

         //Fetch footer menu in Backend
         view()->composer(['frontend.business.includes.footer'], function ($view)
         {
             $category = Category::all();
             $sitelinksMenu = Menus::where('type', SITE_LINKS)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
             $popularcitiesMenu = Menus::where('type', POPULAR_CITIES)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
             $usefullinksMenu = Menus::where('type', USEFUL_LINKS)->where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
             $view->with('sitelinksMenu', $sitelinksMenu)
             ->with('popularcitiesMenu', $popularcitiesMenu)
             ->with('usefullinksMenu', $usefullinksMenu)
             ->with('category', $category);
         });

    }
}
