<?php

namespace App\Mail;

use App\Models\Persona;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CalificacionesMail extends Mailable
{
    use Queueable, SerializesModels;
    public Alumno $persona;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $persona)
    {
        $this->subject = $subject;
        $this->persona = $persona;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.calificaciones')->subject($this->subject)->with('persona', $this->persona);
    }
}
