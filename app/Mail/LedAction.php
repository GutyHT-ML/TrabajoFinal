<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LedAction extends Mailable
{
    use Queueable, SerializesModels;
    public $led, $status;

    public function __construct(int $LED, string $STATUS)
    {
        $this->led = $LED;
        $this->status = $STATUS;
    }

    public function build()
    {
        return $this->markdown('ledaction');
    }
}
