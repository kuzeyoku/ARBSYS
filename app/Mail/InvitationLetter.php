<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $side;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($side,$pdf)
    {
        $this->side = $side;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invitation_letter')->attachData($this->pdf, 'Davet Mektubu.pdf')->subject("Davet Mektubu");
    }
}
