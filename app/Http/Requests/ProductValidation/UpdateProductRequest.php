<?php

namespace App\Http\Requests\ProductValidation\UpdateProductRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\ProductController;

class UpdateCategoryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'productBarcode' => 'required|unique:product,productBarcode' .$id,
            'productStatus' => 'required', 
        ];
    }     
    public function messages(): array{
        return[
            'productTitle.required' => 'Ürün adı zorunludur.',
            'productBarcode.required' => 'Ürün barkodu zorunludur.',
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.',
            'productStatus.required' => 'Ürün durumu zorunludur.'
        ];
    }  
}