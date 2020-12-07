<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SensorValue extends Mailable
{
    use Queueable, SerializesModels;
    public $sensor, $value;

    public function __construct(string $SENSOR, $VALUE)
    {
        $this->sensor = $SENSOR;
        $this->value = $VALUE;
    }

    public function build()
    {
        return $this->markdown('sensorvalue');
    }
}
