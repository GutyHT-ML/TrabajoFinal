<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function signIn(){
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
        TokenApp::create(['user_id'=>$user->id,'token'=>$response]);
        $token = $user->createToken($request->email, ['user:user'])->plainTextToken;
        Mail::to($user)->send(new Access($request->email));
        return response()->json(['token'=>$token], 201);
    }
}
