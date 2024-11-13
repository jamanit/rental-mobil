<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\M_setting;

class SettingProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $id = 1;
            $setting = M_setting::where('id', $id)->first();

            $view->with('setting', $setting);
        });
    }

    public function register()
    {
        //
    }
}
