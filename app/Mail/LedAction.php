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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $LED, string $STATUS)
    {
        $this->led = $LED;
        $this->status = $STATUS;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170050@uttcampus.edu.mx')->markdown('ledaction',['led' => $this->led, 'status'=>$this->status]);
    }
}
