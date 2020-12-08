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
        $sensores = Sensor::where('sensor', 'led')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getTemperature(){
        $sensores = Sensor::where('sensor', 'temperatura')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getHumidity(){
        $sensores = Sensor::where('sensor', 'humedad')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getLight(){
        $sensores = Sensor::where('sensor', 'luz')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getDistance(){
        $sensores = Sensor::where('sensor', 'distancia')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }

    public function getPresence(){
        $sensores = Sensor::where('sensor', 'presencia')->get();
        return response()->json(['sensores'=>$sensores], 200);
    }
}
