<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->route('user')),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        
        return [
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'email.unique' => 'O email já está em uso.',
        ];
    }
}
