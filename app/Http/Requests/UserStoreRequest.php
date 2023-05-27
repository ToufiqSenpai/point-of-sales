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
            'name' => 'required|max:255',
            'username' => 'required|unique:user|max:20',
            'password' => 'required|max:50',
            'email' => 'nullable|email:rfc,dns|unique:user',
            'phone' => 'nullable|unique:user'
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
