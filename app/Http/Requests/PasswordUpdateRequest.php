<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => ['required'],
            'email' => ['required','email'],
            'password' => ['required','string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Parece que sua seção expirou, tente novamente!',
            'email.required' => 'Campo obrigatório',
            'password.required' => 'Campo obrigatório',
            'password.min'  => 'Mínimo de 8 caracteres',
            'password.confirmed' => 'Senhas diferentes',
        ];
    }
}
