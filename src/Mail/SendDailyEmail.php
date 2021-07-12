<?php

namespace Kwreach\Ads\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDailyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $ad)
    {
        $this->user = $user;
        $this->ad = $ad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SendDailyEmail
    {
        return $this->markdown('ads::email.sendDailyEmail');
    }
}
