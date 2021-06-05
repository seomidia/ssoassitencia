<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Sendtrabalheconosco extends Mailable
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
        $this->Telefone = $data->telefone;
        $this->Arquivo = $data->arquivo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Trabahe conosco - curriculum.');
        $this->to($this->EmailTo,$this->Nome);
        $this->attach(storage_path('app/') . $this->Arquivo);

        return $this->markdown('email.trabalhe',[
            'name' => $this->Nome,
            'sobrenome' => $this->Sobrebome,
            'email' => $this->Email,
            'telefone' => $this->Telefone
        ]);

    }
}

