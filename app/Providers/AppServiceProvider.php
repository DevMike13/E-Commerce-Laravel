<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

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
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en','zh_CN', 'vi'])
                ->flags([
                    'en' => asset('images/flags/us.svg'),
                    'zh_CN' => asset('images/flags/cn.svg'),      
                    'vi' => asset('images/flags/vn.svg'),
                ])
                ->circular();
        });
    }
}
