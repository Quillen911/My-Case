<?php
namespace App\Http\Controllers;

use App\Http\Requests\AuthValidation\PostSettingsRequest;
use App\Http\Requests\AuthValidation\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    
    public function showLogin()
    {
        return view('auth.login'); 

    }

    public function login(LoginRequest $request)
    {
        $info = $request->only('email','password'); //veri aldı
        
        if(\Auth::attempt($info)){
            return redirect()->route('main'); //doğruysa giriş
        }
        return view('auth.login', ['error' => 'Email veya şifre yanlış']);
    }

    public function getSettings(Request $request)
    {
        $user = \Auth::user();
        return view('auth.settings', [
            'admin' => $user,
            'success' => session('success'),
            'error' => session('error'),
        ]);
    }

    public function postSettings(PostSettingsRequest $request)
    {
        $user = \Auth::user();
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ]);    
        return redirect()->route('getSettings')->with('success', 'Bilgiler başarıyla güncellendi.');

    }
    public function main()
    {
        return view('auth.main');

    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('login.form');

    }

}


