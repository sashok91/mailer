<?php

namespace App\Mail;

use App\Models\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailing;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mailing $mailing)
    {
        $this->mailing = $mailing;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('robot@mailing.com')
            ->view('mails.custommails', [
                'text' => $this->mailing->email_text
            ]);
    }
}
