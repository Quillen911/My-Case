<?php

namespace App\Http\Requests\UserValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Controllers\UserController;

class ShowUserRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        return[
            'username' => [
                'required',
                'alpha_num',
                'regex:/^\S+$/',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'email' => [
                'required',
                'email', 
                Rule::unique('users', 'email')->ignore($id)
            ],
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
            ],
        ];    
    }
    
    public function messages(): array
    {
        return [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.required' => 'E-posta zorunludur.',
            'password.required' => 'Şifre zorunludur.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',
            'password.regex' => 'Şifre en az bir büyük harf, bir küçük harf ve bir rakam içermelidir.',
        ];        
    } 
}