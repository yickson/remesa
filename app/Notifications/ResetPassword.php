<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $locale = app()->getLocale();
        return (new MailMessage)
            ->subject('Reestablece tu contraseña - ' . config('app.name'))
            ->line('Este correo fue enviado a solicitud tuya.')
            ->action('Reinicia tu contraseña', url('/password/reset', $this->token))
            ->line(' Si tu no has solicitado cambio de contraseña, entonces actualiza tu clave inmediatamente.')
            ->salutation('Saludos, Tranfex');
    }
}
