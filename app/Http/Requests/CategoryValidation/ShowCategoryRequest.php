<?php

namespace App\Http\Requests\CategoryValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowCategoryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array
    {
        $id = $this->route('id');
        return[
            'categoryTitle' => [
                'required',
                Rule::unique('category', 'categoryTitle')->ignore($id),
            ],
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ];
    }
    public function messages(): array
    {
        return[
            'categoryTitle.required' => 'Kategori adı zorunludur.',
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.',
            'categoryDesc.required' => 'Kategori açıklaması zorunludur.',
            'categoryStatus.required' => 'Kategori durumu zorunludur.',
        ];
    }
}
