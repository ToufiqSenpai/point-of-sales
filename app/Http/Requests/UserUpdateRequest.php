<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'username' => 'required|max:20|unique:users,username,'. $this->get('id'),
            'email' => 'nullable|email:rfc,dns|unique:users,email,'. $this->get('id'),
            'phone' => 'nullable|unique:users,phone,'. $this->get('id'),
            'role' => [new Enum(UserRole::class), 'required']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'username' => 'Username',
            'email' => 'Email',
            'phone' => 'No. Telepon',
            'role' => 'Role'
        ];
    }
}
