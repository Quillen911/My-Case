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
            'username' =>
            [

                'required',
                'alpha_num',
                'regex:/^\S+$/',
                Rule::unique('users', 'username')->ignore($id),

            ],
            'email' => 
            [

                'required',
                'email', 
                Rule::unique('users', 'email')->ignore($id)

            ],
        ];    
    }
    //message
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