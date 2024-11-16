<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $emailBody;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $emailBody
     * @return void
     */
    public function __construct($subject, $emailBody)
    {
        $this->subject = $subject;
        $this->emailBody = $emailBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('company.application.email-notif')  
                    ->with([
                        'emailBody' => $this->emailBody
                    ]);
    }
}