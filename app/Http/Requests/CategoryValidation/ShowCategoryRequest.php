<?php

namespace App\Http\Requests\CategoryValidation\ShowCategoryRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\CategoryController;

class ShowCategoryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        $id = $this->route('id');
        return[
            'categoryTitle' => 'required|unique:category,categoryTitle',
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ];
    }
    public function messages(): array{
        return[
            'categoryTitle.required' => 'Kategori adı zorunludur.',
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.',
            'categoryDesc' => 'Kategori açıklaması zorunludur.',
            'categoryStatus' => 'Kategori durumu zorunludur.',
        ];
    }
}
