<?php

namespace App\Http\Requests\AuthValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\AuthController;

class PostSettingsRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        $userId = Auth::id();
        return[
            'username' => [
                'required',
                'unique:users,username,' . $userId,
                'alpha_num',
                'regex:/^\\S+$/'
            ],
            'email' => 'required|email|unique:users,email,' . $userId,
        ];
    }
    public function messages(): array{
        return [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
        ];
    }
}