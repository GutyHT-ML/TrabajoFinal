<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\LedAction;
use App\Mail\SensorValue;
use Illuminate\Support\Facades\Mail;

class AdafruitController extends Controller
{
    private $key = "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET";

    public function __construct()
    {
        //$this->middleware('auth:sanctum');
    }

    public function LED(Request $request, $num){
        switch($num){
            case 1:
                $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led1/data";
                break;
            case 2:
                $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led2/data";
                break;
        }
        $request->validate([
            'value'=>'required|boolean'
        ]);
        if($request->value){
            $value = 'ON';
        } else{
            $value = 'OFF';
        }
        $response = Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => $value
        ]);
        Mail::to($request->user())->send(new LedAction($num, $value));
        return $response->json(["Led ".$num." value" => $value]);
    }

    // public function LED1_OFF(Request $request){
    //     $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led1/data";
    //     $response = Http::post($url, [
    //         'X-AIO-Key' => $this->key,
    //         'value' => 'OFF'
    //     ]);
    //     Mail::to($request->user())->send(new LedAction('1', 'OFF'));
    //     return $response->json(["Led 1 Value" => "OFF"]);
    // }

    // public function LED2_ON(Request $request){
    //     $response = Http::post($url, [
    //         'X-AIO-Key' => $this->key,
    //         'value' => 'ON'
    //     ]);
    //     Mail::to($request->user())->send(new LedAction('2', 'ON'));
    //     return $response->json(["Led 2 Value" => "ON"]);
    // }

    // public function LED2_OFF(Request $request){
    //     $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led2/data";
    //     $response = Http::post($url, [
    //         'X-AIO-Key' => $this->key,
    //         'value' => 'OFF'
    //     ]);
    //     Mail::to($request->user())->send(new LedAction('2', 'OFF'));
    //     return $response->json(["Led 2 Value" => "OFF"]);
    // }

    public function temperatura(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/temperature/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        Mail::to($request->user())->send(new SensorValue('Temperatura', $respuesta[0]['value']));
        return $respuesta[0]['value'];
    }

    public function humedad(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/humidity/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        Mail::to($request->user())->send(new SensorValue('Humedad', $respuesta[0]['value']));
        return $respuesta[0]['value'];
    }

    public function luz(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/photocell/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        Mail::to($request->user())->send(new SensorValue('Luz', $respuesta[0]['value']));
        return $respuesta[0]['value'];
    }

    public function distancia(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/distance/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        Mail::to($request->user())->send(new SensorValue('Distancia', $respuesta[0]['value']));
        return $respuesta[0]['value'];
    }

    public function presencia(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/PIR/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        Mail::to($request->user())->send(new SensorValue('PIR', $respuesta[0]['value']));
        return $respuesta[0]['value'];
    }
}
