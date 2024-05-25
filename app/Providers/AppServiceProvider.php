<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleService::class, function ($app) {
            return new GoogleService(auth()->user()); // or some other logic to determine the user
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('isRequired', function ($expression) {
            return "<?php echo in_array('required', explode('|', \$rules[$expression])) ? '<span style=\"color: red;\">*</span>' : ''; ?>";
        });
    }
}
