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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $SENSOR, $VALUE)
    {
        $this->sensor = $SENSOR;
        $this->value = $VALUE;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170050@uttcampus.edu.mx')->markdown('sensorvalue',['sensor' => $this->sensor, 'value'=>$this->value]);
    }
}
