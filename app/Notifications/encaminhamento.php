<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class encaminhamento extends Notification
{
    use Queueable;

    protected $Data = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($Data)
    {
        $this->Data =$Data;
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
        $paciente = $this->Data['paciente'];
        $cpf = $this->Data['cpf'];
        $nasc = $this->Data['nasc'];
        $empresa = $this->Data['empresa'];
        $clinica = $this->Data['clinica'];
        $endereco = $this->Data['endereco'];


        return (new MailMessage)
                    ->subject('SSO Assessoria - Questionário anamnese')
                    ->greeting('Ola ' . $nome)
                    ->line('Foi encaminhada uma anamnese para você responder.')
                    ->line('Dados do paciente:')
                    ->line('Nome:'. $paciente)
                    ->line('CPF:'. $cpf)
                    ->line('Nasc:'. $nasc)
                    ->line('Empresa:'. $empresa)
                    ->line('Clinica:'. $clinica)
                    ->line('Endereço:'. $endereco)
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
