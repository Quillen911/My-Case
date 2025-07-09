<?php

namespace App\Http\Requests\UserValidation;

use Illuminate\Foundation\Http\FormRequest;

class BulkDeleteUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_ids'   => 'required|array|min:1',
            'user_ids.*' => 'integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_ids.required' => 'Lütfen silmek için en az bir kullanıcı seçin.',
            'user_ids.array'    => 'Kullanıcılar bir dizi olarak gönderilmelidir.',
            'user_ids.min'      => 'Lütfen silmek için en az bir kullanıcı seçin.',
            'user_ids.*.integer'=> 'Kullanıcı ID\'leri geçersiz.',
            'user_ids.*.exists' => 'Seçilen kullanıcı(lar) bulunamadı.',
        ];
    }
} 