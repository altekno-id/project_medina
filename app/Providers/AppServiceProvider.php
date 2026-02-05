<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;

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
        Blade::directive('active', function ($expression) {
            return "<?php echo Request::routeIs($expression) ? 'active' : ''; ?>";
});

Blade::directive('openIfActive', function ($expression) {
return "<?php echo Request::routeIs($expression) || Request::routeIs('{$expression}.*') ? 'open' : ''; ?>";
});
}
}