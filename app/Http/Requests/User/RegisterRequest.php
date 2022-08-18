<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nombre'   => ['required'],
            'password' => ['required'],
            'username' => ['required', 'unique:users']
        ];
    }

    public function messages()
    {
        return [
            'password' => 'Contraseña',
            'username' => 'Nombre de usuario'
        ];
    }
}
