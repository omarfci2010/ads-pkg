<?php

namespace Kwreach\Ads\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Kwreach\Ads\Console\Commands\SendDailyEmail;

class AdsServiceProvider extends ServiceProvider {

    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('daily:email')->dailyAt("20:00");
        });
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../views', 'ads');

    }

   /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->commands([
            SendDailyEmail::class,
        ]);
    }

}
