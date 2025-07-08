<?php

namespace App\Http\Requests\UserValidation\UpdateUserRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\UserController;

class UpdateUserRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); 
        return[
            'username' =>[
                'required',
                'alpha_num',
                'regex:/^\S+$/',
                'unique:users,username,' . $id,
            ],
            'email' => 'required|email|unique:users,email,' .$id,
        ];
    }
    public function messages(): array
    {
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