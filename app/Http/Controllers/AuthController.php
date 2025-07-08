<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller{
    
    public function showLogin(){
        return view('auth.login'); 
    }

    public function login(Request $request){
        $info = $request->only('email','password'); //veri aldı

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(\Auth::attempt($info)){
            return redirect()->route('main'); //doğruysa giriş
        }
        return view('auth.login', ['error' => 'Email veya şifre yanlış']);
    }

    public function getSettings(Request $request){
        $user = \Auth::user();
        return view('auth.settings', [
            'admin' => $user, // blade'de değişiklik yapmadan çalışsın diye
            'success' => session('success'),
            'error' => session('error'),
        ]);
    }

    public function postSettings(Request $request){
        $user = \Auth::user();
        $messages = [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
        ];
        $validator = \Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:users,username,' . $user->id,
                'alpha_num',
                'regex:/^\\S+$/'
            ],
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('getSettings')->withInput()->with('error', $validator->errors()->first());
        }

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('getSettings')->with('success', 'Bilgiler başarıyla güncellendi.');
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('login.form');
    }

}


