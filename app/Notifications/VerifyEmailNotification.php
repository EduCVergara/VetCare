<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail
{
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject('Verifica tu correo en VetCare')
            ->greeting('Hola,')
            ->line('Te damos la bienvenida a VetCare.')
            ->line('Antes de comenzar, necesitamos verificar tu dirección de correo electrónico.')
            ->action('Verificar correo', $url)
            ->line('Si no creaste esta cuenta, puedes ignorar este mensaje.');
    }
}
