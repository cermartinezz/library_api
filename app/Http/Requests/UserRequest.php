<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name'    => ['required','string'],
            'last_name'     => ['required','string'],
            'email'         => ['required','string','email',Rule::unique('users','email')],
            'password'      => ['required','min:8'],
            'role_id'       => ['required','integer', Rule::exists('roles','id')]
        ];
    }
}
