<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required_without:advert_id|nullable|uuid|exists:users,id',
            'advert_id' => 'required_without:user_id|nullable|uuid|exists:adverts,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:200',
        ];
    }
}
