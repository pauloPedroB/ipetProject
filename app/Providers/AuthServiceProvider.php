<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url) {
            // Verifique se o usuário está usando um dispositivo móvel
           // if (Agent::isMobile()) {
                // Construa o URL usando o esquema de URL personalizado
             //   $mobileVerificationUrl = 'meuapp://verificar-email/' . urlencode($url);

               // return (new MailMessage)
                 //   ->subject('Verifique seu E-mail')
                   // ->line('Por favor, clique no link abaixo para verificar seu E-mail')
                    //->action('Verifique seu E-mail', $mobileVerificationUrl)
                    //->line('Se você não criou uma conta, nenhuma ação é requerida!');
            //}

            return (new MailMessage)
                ->subject('Verifique seu E-mail')
                ->line('Por favor, clique no link abaixo para verificar seu E-mail')
                ->action('Verifique seu E-mail', $url)
                ->line('Se você não criou uma conta, nenhuma ação é requerida!');
        });
        ResetPassword::toMailUsing(function($notifiable,$token){
            $resetUrl = url('reset-password', $token);
            $expires = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
            return (new MailMessage)
                    ->subject('Notificação de Reset de senha')
                    ->line('Se você está recebendo este e-mail, é porque recebemos um pedido de reset de senha para sua conta')
                    ->action('Resetar senha',$resetUrl)
                    ->line('Este link de reset de senha espirará em: '.$expires.' minutos.')
                    ->line('Se você não requisitou o reset, ignore está mensagem');
        });
    }
}
