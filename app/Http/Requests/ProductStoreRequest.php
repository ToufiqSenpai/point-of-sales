<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:199|unique:products',
            'barcode' => 'nullable|max:99|unique:products',
            'sku' => 'nullable|max:12|unique:products',
            'description' => 'nullable|max:20000',
            'image' => 'nullable|file|image|max:10485760',
            'brand_id' => 'required|exists:product_brands,id',
            'category_id' => 'required|exists:product_categories,id',
            'unit_id' => 'required|exists:product_units,id',
            'base_price' => 'required|numeric|max_digits:9',
            'selling_price' => 'required|numeric|max_digits:9'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Harus diisi',
            'unique' => ':attribute sudah tersedia',
            'max' => ':attribute terlalu panjang',
            'image.max' => 'File terlalu besar'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'barcode' => 'Barcode',
            'sku' => 'SKU',
            'description' => 'Deskripsi',
            'image' => 'Foto',
            'brand_id' => 'Brand',
            'category_id' => 'Kategori',
            'unit_id' => 'Unit',
            'base_price' => 'Harga dasar',
            'selling_price' => 'Harga jual'
        ];
    }

//    public function withValidator(Validator $validator): void
//    {
//        $validator->after(function (Validator $validator) {
//            dd($this->validator->errors(), $this->all());
//        });
//    }
}
