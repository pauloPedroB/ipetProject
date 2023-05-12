<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class MyCustomAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Define a URL personalizada para redirecionar o usuário de volta para o aplicativo após a verificação de email
        \Illuminate\Auth\Notifications\VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                    'custom_redirect' => 'myapp://verification-successful', // Substitua pelo esquema personalizado do seu aplicativo
                ]
            );
        });
    }

    public function register(): void
    {
        //
    }
}
