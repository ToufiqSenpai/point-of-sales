<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
            'name' => 'required|max:155|unique:supplier,name,'. $id,
            'phone' => 'required|max:50|unique:supplier,phone,'. $id,
            'email' => 'nullable|email:rfc,dns|unique:supplier,email,'. $id,
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
