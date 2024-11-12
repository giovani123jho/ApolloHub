<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MentorRedirectService;
use App\Services\CompanyRedirectService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registra o binding para 'redirect.mentor'
        $this->app->bind('redirect.mentor', function ($app) {
            return new MentorRedirectService();
        });

        // Registra o binding para 'redirect.company'
        $this->app->bind('redirect.company', function ($app) {
            return new CompanyRedirectService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aqui você pode colocar outras configurações se necessário
    }
}
