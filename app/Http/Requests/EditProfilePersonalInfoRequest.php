<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilePersonalInfoRequest extends FormRequest
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
            "city" => ["nullable", "exists:cities,id"],
            "zip" => ["nullable", "string", "regex:/^[0-9]{5}$/"],
            "phone" => ["nullable", "string", "regex:/^06[0-9]{7,8}$/"],
            "address" => ["nullable", "string", "max:255"]
        ];
    }
}
