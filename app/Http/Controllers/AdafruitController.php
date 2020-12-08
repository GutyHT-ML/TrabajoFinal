<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Sensor;
use App\Mail\LedAction;
use App\Mail\SensorValue;
use Illuminate\Support\Facades\Mail;

class AdafruitController extends Controller
{
    private $key = "aio_NOtK07inOFWsf7zU8hjtRYyyEhUT";

    public function __construct()
    {
        $this->middleware('auth:sanctum');
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
        if($request->value == "ON"){
            $value = 'ON';
        } else if($request->value == "OFF"){
            $value = 'OFF';
        }
        Http::post($url, [
            'X-AIO-Key' => $this->key,
            'value' => $value
        ]);
        Mail::to($request->user())->send(new LedAction($num, $value));
        Sensor::create([
            'sensor'=>'led',
            'value'=>strval($value),
            'user_id'=>$request->user()->id
        ]);
        return response()->json(["Led ".$num." value" => $value]);
    }

    public function temperatura(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/temperature/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => $this->key,
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        $value = $respuesta[0]['value'];
        Mail::to($request->user())->send(new SensorValue('Temperatura', $respuesta[0]['value']));
        Sensor::create([
            'sensor'=>'temperatura',
            'value'=>strval($value),
            'user_id'=>$request->user()->id

        ]);
        return response()->json(['Response'=>$respuesta[0]['value']], 201);
    }

    public function humedad(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/humidity/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => $this->key,
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        $value = $respuesta[0]['value'];
        Mail::to($request->user())->send(new SensorValue('Humedad', $respuesta[0]['value']));
        Sensor::create([
            'sensor'=>'humedad',
            'value'=>strval($value),
            'user_id'=>$request->user()->id

        ]);
        return response()->json(['Response'=>$respuesta[0]['value']], 201);
    }

    public function luz(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/photocell/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => $this->key,
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        $value = $respuesta[0]['value'];
        Mail::to($request->user())->send(new SensorValue('Luz', $respuesta[0]['value']));
        Sensor::create([
            'sensor'=>'luz',
            'value'=>strval($value),
            'user_id'=>$request->user()->id
        ]);
        return response()->json(['Response'=>$respuesta[0]['value']], 201);
    }

    public function distancia(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/distance/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => $this->key,
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        $value = $respuesta[0]['value'];
        Mail::to($request->user())->send(new SensorValue('Distancia', $respuesta[0]['value']));
        Sensor::create([
            'sensor'=>'distancia',
            'value'=>strval($value),
            'user_id'=>$request->user()->id
        ]);
        return response()->json(['Response'=>$respuesta[0]['value']], 201);
    }

    public function presencia(Request $request){
        $url = "https://io.adafruit.com/api/v2/KappitaRoss/feeds/PIR/data?limit=1";
        $response = Http::get($url, [
            'X-AIO-Key' => $this->key,
            'limit' => '1'
        ]);
        $respuesta = json_decode($response, true);
        $value = $respuesta[0]['value'];
        Mail::to($request->user())->send(new SensorValue('PIR', $respuesta[0]['value']));
        Sensor::create([
            'sensor'=>'presencia',
            'value'=>strval($value),
            'user_id'=>$request->user()->id
        ]);
        return response()->json(['Response'=>$respuesta[0]['value']], 201);
    }
}
