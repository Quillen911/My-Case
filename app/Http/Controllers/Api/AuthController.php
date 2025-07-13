<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthValidation\LoginRequest;
use App\Http\Requests\AuthValidation\PostSettingsRequest;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->input('email'))->first();
        if(! $user || ! Hash::check($request->input('password'), $user->password))
        {
            return response()->json(['message' => 'Email veya şifre yanlış'],401);
        }    

        $token = $user->createToken('apitoken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
        
    }
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Çıkış Yapıldı.']);

    }
    public function me(Request $request){

        return response()->json($request->user());

    }

}