<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class estandarMail extends Mailable
{
    use Queueable, SerializesModels;

    public $titulo;
    public $descripcion;
    public $textoBoton;
    public $urlBoton;
    public $asunto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo, $descripcion, $textoBoton, $urlBoton, $asunto)
    {
        $this->titulo      = $titulo;
        $this->descripcion = $descripcion;
        $this->textoBoton  = $textoBoton;
        $this->urlBoton    = $urlBoton;
        $this->asunto      = $asunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.estandar')->subject($this->asunto);
    }
}
