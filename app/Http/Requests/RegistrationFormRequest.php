<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "account_type" => "required",
            "username" => "required",
            "email" => "required|email",
            "password" => "required|confirmed",
        ];

        if ($this->input('account_type') === 'business') {
            $rules['companyName'] = 'required';
            $rules['kvk'] = 'required';
            $rules['url'] = 'required';
        }

        return $rules;
    }
}
