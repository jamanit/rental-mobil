<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\M_business_profile;

class BusinessProfileProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $id = 1;
            $business_profile = M_business_profile::where('id', $id)->first();

            $view->with('business_profile', $business_profile);
        });
    }

    public function register()
    {
        //
    }
}
