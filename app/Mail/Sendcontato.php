<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Sendcontato extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $data)
    {
        $this->Nome = $data->nome;
        $this->Sobrebome = $data->sobrebome;
        $this->EmailTo = $data->emailTo;
        $this->Email = $data->email;
        $this->Assunto = $data->assunto;
        $this->Mensagem = $data->mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Contato  do site SSO.');
        $this->to($this->EmailTo,$this->Nome);

        return $this->markdown('email.contato',[
            'name' => $this->Nome,
            'sobrenome' => $this->Sobrebome,
            'email' => $this->Email,
            'assunto' => $this->Assunto,
            'mensagem' => $this->Mensagem
        ]);

    }
}

