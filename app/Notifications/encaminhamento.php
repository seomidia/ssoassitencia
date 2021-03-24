<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class encaminhamento extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $url     = url('/admin/funcionario/anaminese');
        $nome    = $notifiable->name;
        $email    = $notifiable->email;


        return (new MailMessage)
                    ->subject('SSO Assessoria - Questionário anamnese')
                    ->greeting('Ola ' . $nome)
                    ->line('Foi encaminhada uma anamnese para você responder.')
                    ->line('Dados de sua conta:')
                    ->line('Usuario: ' .$email)
                    ->line('Senha: (Seu cpf)')
                    ->action('Questionário', $url);
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
