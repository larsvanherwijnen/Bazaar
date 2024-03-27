<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAdvertRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'price' => 'required_if:type,Sale,Rental',
            'starting_price' => 'required_if:type,Auction,Bidding',
            'start_date' => 'nullable|required_if:type,Auction|date',
            'end_date' => 'nullable|required_if:type,Auction|date|after:start_date',
        ];


    }
}
