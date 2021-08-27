<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as NotificationsResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends NotificationsResetPassword
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Solicitud de Cambio de Contraseña')
            ->line('Está recibiendo este email porque ha solicitado cambiar la contraseña.')
            ->action('Cambiar Contraseña',
                url(config('app.url') . route('password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset()
                ], false)))
            ->line('')
            ->line('Este enlace caducará en ' . config('auth.passwords.users.expire') . ' minutos.')
            ->line('Si no ha solicitado el cambio de contraseña, no tiene que hacer nada.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
