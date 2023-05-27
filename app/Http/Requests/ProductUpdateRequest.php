<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $id = $this->get('id');
        return [
            'id' => 'required',
            'name' => 'required|max:199|unique:product,name,'. $id,
            'barcode' => 'nullable|max:99|unique:product,barcode,'. $id,
            'sku' => 'nullable|max:12|unique:product,sku,'. $id,
            'description' => 'nullable|max:20000',
            'image' => 'nullable|file|image|max:10485760',
            'brand_id' => 'required|exists:product_brand,id',
            'category_id' => 'required|exists:product_category,id',
            'unit_id' => 'required|exists:product_unit,id',
            'base_price' => 'required|numeric|max_digits:9',
            'selling_price' => 'required|numeric|max_digits:9'
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
}
