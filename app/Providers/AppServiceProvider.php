<?php

namespace App\Providers;

use App\Asset;
use App\Observers\AssetObserver;
use App\Observers\TeamObserver;
use App\Team;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->roles()->where('role_id', 1)->first() != null;
        });

        Blade::if('user', function () {
            return auth()->check() && auth()->user()->roles()->where('role_id', 2)->first() != null;
        });

        Asset::observe(AssetObserver::class);
        Team::observe(TeamObserver::class);
        Blade::directive('money', function ($amount) {
            return "<?php echo 'Rs ' . number_format($amount, 2); ?>";
        });
        Blade::directive('moneyF', function ($amount) {
            return "<?php echo number_format($amount, 2); ?>";
        });
     
    }
}
