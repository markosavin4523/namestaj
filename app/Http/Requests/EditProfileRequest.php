<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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

            "username"   => [
                "required",
                "string",
                "regex:/^[a-z0-9._]+$/",
                Rule::unique('users')->ignore(auth()->id())
            ],

            "email"      => [
                "required",
                "email",
                Rule::unique('users')->ignore(auth()->id())
            ],
        ];
    }
}
