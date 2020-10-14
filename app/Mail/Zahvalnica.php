<?php

namespace App\Mail;

use App\Racun;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Zahvalnica extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
     protected $racun;

    public function __construct(Racun $racun)
    {
        $this->racun=$racun;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.zahvalnica')->with([
            'id' => $this->racun->id,
            'ime'=> $this->racun->ime,
        ]);
    }
}
