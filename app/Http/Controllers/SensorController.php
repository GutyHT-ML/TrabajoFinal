<?php

namespace App\Http\Controllers;

use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getLed(){
        $sensores = Sensor::where('sensor', 'led');
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getTemperature(){
        $sensores = Sensor::where('sensor', 'temperatura');
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getHumidity(){
        $sensores = Sensor::where('sensor', 'humedad');
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getLight(){
        $sensores = Sensor::where('sensor', 'luz');
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getDistance(){
        $sensores = Sensor::where('sensor', 'distancia');
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getPresence(){
        $sensores = Sensor::where('sensor', 'presencia');
        return response()->json(['sensores'=>$sensores], 200);
    }
}
