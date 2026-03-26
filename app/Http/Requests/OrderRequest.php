<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        return [
            "first_name" => ["required", "string", "regex:/^[A-Z][a-z]{2,12}$/"],
            "last_name"  => ["required", "string", "regex:/^[A-Z][a-z]{2,12}$/"],
            "city" => ["required", "exists:cities,id"],
            "zip" => ["required", "string", "regex:/^[0-9]{5}$/"],
            "phone" => ["required", "string", "regex:/^06[0-9]{7,8}$/"],
            "address" => ["required", "string", "max:255"]
        ];
    }
}
