<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'name' => 'required|max:155|unique:suppliers',
            'phone' => 'required|unique:suppliers|max:50',
            'email' => 'nullable|unique:suppliers|email:rfc,dns',
            'address' => 'nullable|max:10000',
            'description' => 'nullable|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Harus diisi',
            'unique' => ':attribute sudah tersedia',
            'max' => ':attribute terlalu panjang',
            'email' => 'Email tidak valid'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'phone' => 'No. Telepon',
            'email' => 'Email',
            'address' => 'Alamat',
            'description' => 'Deskripsi'
        ];
    }
}
