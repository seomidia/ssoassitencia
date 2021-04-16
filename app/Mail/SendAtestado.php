<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendAtestado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $data)
    {
        $this->Anamnese = $data->anamnese;
        $this->Email = $data->email;
        $this->Name = $data->name;
        $this->Conta = $data->conta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('SSO ASSESSORIA - Atestado.');
        $this->to($this->Email,$this->Name);
        $this->attach(storage_path('app/public/atestados/img/'.$this->Conta.'/'.$this->Conta . '-anamnese-'. $this->Anamnese .'.png'));
        return $this->markdown('email.atestado',[
            'name' => $this->Name,
        ]);

    }
}
