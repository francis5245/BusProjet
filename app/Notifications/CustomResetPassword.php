<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Canaux de notification
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Email envoyé
     */
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->view('emails.reset-password', [
                'user' => $notifiable,
                'url' => $url,
            ]);

    }
}
