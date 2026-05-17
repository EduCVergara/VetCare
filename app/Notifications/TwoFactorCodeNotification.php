<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $code,
        private readonly int $expiresMinutes,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Código de acceso VetCare')
            ->greeting('Hola,')
            ->line('Usa este código para completar tu inicio de sesión:')
            ->line($this->code)
            ->line("El código expira en {$this->expiresMinutes} minutos.")
            ->line('Si no intentaste iniciar sesión, cambia tu contraseña.');
    }
}
