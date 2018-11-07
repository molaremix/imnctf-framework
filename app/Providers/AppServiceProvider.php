<?php

namespace App\Providers;

use App\Models\Hint;
use App\Models\Team;
use App\Observers\HintObserver;
use App\Observers\TeamObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Hint::observe(HintObserver::class);
        Team::observe(TeamObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
