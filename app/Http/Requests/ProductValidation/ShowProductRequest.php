<?php

namespace App\Http\Requests\ProductValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowProductRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array
    {
        $id = $this->route('id');
        return[
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'productStatus' => 'required',
            'productBarcode' => [
                'required',
                Rule::unique('product', 'productBarcode')->ignore($id),
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'productTitle.required' => 'Ürün adı zorunludur.',
            'productBarcode.required' => 'Ürün barkodu zorunludur.',
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.',
            'productStatus.required' => 'Ürün durumu zorunludur.'
        ];
    }
}