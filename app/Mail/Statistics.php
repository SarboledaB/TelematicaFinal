<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Statistics extends Mailable
{
    use Queueable, SerializesModels;

    public $statistics;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($stats)
    {
        $this->statistics = $stats;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.statistiscs');
    }
}
