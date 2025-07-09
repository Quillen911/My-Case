<?php

namespace App\Http\Requests\UserValidation;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\UserController;

class AdminVerifyRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules():array{
        $id = $this->route('id');
        return[
            'password' => 'required',
        ];
    } 
    public function messages(): array //mesaj
    {
        return [
            'password.required' => 'Şifre alanı boş bırakılamaz.',
        ];
    }
}