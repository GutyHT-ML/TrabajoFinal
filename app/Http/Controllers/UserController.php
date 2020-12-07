<?php

namespace App\Http\Controllers;

use App\Mail\Access;
use App\Mail\Register;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function showUser(Request $request){
        return $request->user();
    }

    public function signIn(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            Mail::to($user->email)->send(new Register($request->name, $request->email));
            return response()->json(['User'=>$user], 201);
        }

        return abort(400, 'Error al generar el registro');
    }
    public function logIn(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        $token = $user->createToken($request->email, ['user:user'])->plainTextToken;
        Mail::to($user->email)->send(new Access($request->email));
        return response()->json(['token'=>$token], 201);
    }

    public function logOut(Request $request){
        return response()->json(['afectados'=>$request->user()->tokens()->delete()], 200);
    }
}
