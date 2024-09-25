<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $url = '';

        if ($this->user->role == 'company') {
            $url = url('/login?token=' . $this->token);
        } elseif ($this->user->role == 'applicant') {
            $url = url('/profile/education-skills-experience/' . $this->token);
        }
        
        // dd($this->token, $url);

        return $this->view('emails.verify')
            ->with([
                'user' => $this->user,
                'url' => $url,
            ]);
    }
}
