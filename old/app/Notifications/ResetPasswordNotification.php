<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    /**
     * Le token de réinitialisation.
     *
     * @var string
     */
    public $token;

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Obtenir les canaux de livraison de la notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Construire le message de réinitialisation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->line('Vous avez demandé une réinitialisation de votre mot de passe.')
            ->action('Réinitialiser le mot de passe', url(getGuardedRoute('password.reset', $this->token, false)))
            ->line('Si vous n\'êtes pas à l\'origine de cette demande, veuillez ignorer cet e-mail.');
    }
}
