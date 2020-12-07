<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdafruitController extends Controller
{
    private $key = "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET";

    public function __construct()
    {
        //$this->middleware('auth:sanctum');
    }

    public function LED1_ON(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led1/data";
        $response = Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => 'ON'
        ]);
        return $response->json(["Led 1 Value" => "ON"]);
    }

    public function LED1_OFF(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led1/data";
        $response = Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => 'OFF'
        ]);
        return $response->json(["Led 1 Value" => "OFF"]);
    }

    public function LED2_ON(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led2/data";
        $response = Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => 'ON'
        ]);
        return $response->json(["Led 2 Value" => "ON"]);
    }

    public function LED2_OFF(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/led2/data";
        $response = Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => 'OFF'
        ]);
        return $response->json(["Led 2 Value" => "OFF"]);
    }

    public function temperatura(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/temperature/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        return $respuesta[0]['value'];
    }

    public function humedad(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/humidity/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        return $respuesta[0]['value'];
    }

    public function luz(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/photocell/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        return $respuesta[0]['value'];
    }

    public function distancia(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/distance/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        return $respuesta[0]['value'];
    }

    public function presencia(){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/PIR/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => "aio_VDUM31mVkjpRBwY6EUSTWXAOl8ET",
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        return $respuesta[0]['value'];
    }
}
