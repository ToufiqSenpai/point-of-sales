<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|unique:customer,name,'. $id,
            'email' => 'nullable|email:rfc,dns|unique:customer,email,'. $id,
            'phone' => 'required|unique:customer,phone,'. $id,
            'address' => 'nullable|max:10000'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'No. Telepon',
            'address' => 'Alamat'
        ];
    }
}
