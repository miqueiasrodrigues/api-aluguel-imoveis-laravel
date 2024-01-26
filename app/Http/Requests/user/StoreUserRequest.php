<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'account_status' => 'nullable|numeric|in:0,1', 
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'O primeiro nome é obrigatório.',
            'last_name.required' => 'O sobrenome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'image.max' => 'O tamanho máximo da imagem é de :max kilobytes.',
            'account_status.required' => 'O status da conta é obrigatório.',
            'account_status.in' => 'O status da conta deve ser 0 ou 1.', 
        ];
    }
}
