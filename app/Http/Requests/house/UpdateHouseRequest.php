<?php

namespace App\Http\Requests\house;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHouseRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'num_bedrooms' => 'nullable|integer|min:1',
            'num_bathrooms' => 'nullable|integer|min:1',
            'num_suites' => 'nullable|integer|min:0',
            'num_garages' => 'nullable|integer|min:0',
            'size' => 'nullable|numeric|min:0',
            'value' => 'nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'nullable|boolean',
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
            'user_id.exists' => 'O usuário especificado não existe.',
            'title.string' => 'O título deve ser uma string.',
            'title.max' => 'O título não pode ter mais de :max caracteres.',
            'description.string' => 'A descrição deve ser uma string.',
            'num_bedrooms.integer' => 'O número de quartos deve ser um valor inteiro.',
            'num_bedrooms.min' => 'O número de quartos deve ser pelo menos 1.',
            'num_bathrooms.integer' => 'O número de banheiros deve ser um valor inteiro.',
            'num_bathrooms.min' => 'O número de banheiros deve ser pelo menos 1.',
            'num_suites.integer' => 'O número de suítes deve ser um valor inteiro.',
            'num_suites.min' => 'O número de suítes não pode ser negativo.',
            'num_garages.integer' => 'O número de garagens deve ser um valor inteiro.',
            'num_garages.min' => 'O número de garagens não pode ser negativo.',
            'size.numeric' => 'O tamanho da casa deve ser um valor numérico.',
            'size.min' => 'O tamanho da casa não pode ser negativo.',
            'value.numeric' => 'O valor da casa deve ser um valor numérico.',
            'value.min' => 'O valor da casa não pode ser negativo.',
            'main_image.image' => 'O arquivo deve ser uma imagem.',
            'main_image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'main_image.max' => 'O tamanho máximo da imagem é de :max kilobytes.',
            'available.boolean' => 'O valor de disponibilidade deve ser verdadeiro ou falso.',
        ];
    }
}
