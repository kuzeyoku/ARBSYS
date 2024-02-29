<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeRequestConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;

        $this->subject("Kullanıcı Değişiklik Talepleriniz Onaylandı");
        return $this->from("noreply@arbsys.com.tr","ARBSYS")->view("email.changerequestconfirm", compact('data'));
    }
}
