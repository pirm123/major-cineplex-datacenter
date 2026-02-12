<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! request()->hasSession()) {
            return;
        }

        $locale = request()->query('lang');

        if ($locale && in_array($locale, ['th', 'en'], true)) {
            Session::put('locale', $locale);
        }

        App::setLocale(
            Session::get('locale', config('app.locale'))
        );
    }
}
