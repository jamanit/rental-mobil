<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\M_contact;

class ContactProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $contacts = M_contact::get();

            $view->with('contacts', $contacts);
        });
    }

    public function register()
    {
        //
    }
}
