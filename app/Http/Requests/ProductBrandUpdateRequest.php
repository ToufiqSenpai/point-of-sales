<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBrandUpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required|max:99|unique:product_brands,name,'. $this->get('id'),
            'description' => 'nullable|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Harus diisi',
            'unique' => ':attribute sudah tersedia',
            'max' => ':attribute terlalu panjang'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'description' => 'Deskripsi'
        ];
    }
}
