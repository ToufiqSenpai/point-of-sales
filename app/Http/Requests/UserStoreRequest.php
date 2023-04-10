<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:20',
            'password' => 'required|max:50',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'phone' => 'nullable|unique:users'
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
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'phone' => 'No. Telepon'
        ];
    }
}
