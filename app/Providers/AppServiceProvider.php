<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registra o binding para 'redirect.mentor'
        $this->app->bind('redirect.mentor', function ($app) {
            // Substitua 'MentorRedirectService' pela classe que você quer associar ao 'redirect.mentor'
            return new \App\Services\redirect.mentor();
        });

        // Registra o binding para 'redirect.company'
        $this->app->bind('redirect.company', function ($app) {
            // Substitua 'CompanyRedirectService' pela classe que você quer associar ao 'redirect.company'
            return new \App\Services\redirect.company();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registra a classe CreateNewUser para o processo de criação de usuário
        Fortify::createUsersUsing(CreateNewUser::class);
    }
}
