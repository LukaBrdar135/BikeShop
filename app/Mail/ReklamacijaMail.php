<?php

namespace App\Mail;

use App\ReklamacijaOdgovor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReklamacijaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $odgovor;

    public function __construct(ReklamacijaOdgovor $odgovor)
    {
        $this->odgovor= $odgovor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail')->with([
            'email' => $this->odgovor->email,
            'odgovor' => $this->odgovor->poruka,
            'ime' => $this->odgovor->ime,
            'prezime' => $this->odgovor->prezime,
            ]);
    }
}
