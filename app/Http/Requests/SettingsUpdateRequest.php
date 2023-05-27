<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
            'name' => 'required|max:99|string',
            'email' => 'required|email|max:99',
            'phone' => 'required|max:30',
            'address' => 'required|max:10000',
            'invoice_footer' => 'required|max:10000',
            'shop_image' => 'nullable|image|max:10485760'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Shop Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'invoice_footer' => 'Invoice Footer',
            'shop_image' => 'Shop Image'
        ];
    }
}
