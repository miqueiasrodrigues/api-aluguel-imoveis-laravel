<?php

namespace App\Http\Requests\house;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'num_bedrooms' => 'required|integer|min:1',
            'num_bathrooms' => 'required|integer|min:1',
            'num_suites' => 'required|integer|min:0',
            'num_garages' => 'required|integer|min:0',
            'size' => 'required|numeric|min:0',
            'value' => 'required|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'required|boolean',
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
            'user_id.required' => 'O ID do usuário é obrigatório.',
            'user_id.exists' => 'O usuário especificado não existe.',
            'title.required' => 'O título da casa é obrigatório.',
            'description.required' => 'A descrição da casa é obrigatória.',
            'num_bedrooms.required' => 'O número de quartos é obrigatório.',
            'num_bedrooms.integer' => 'O número de quartos deve ser um valor inteiro.',
            'num_bedrooms.min' => 'O número de quartos deve ser pelo menos 1.',
            'num_bathrooms.required' => 'O número de banheiros é obrigatório.',
            'num_bathrooms.integer' => 'O número de banheiros deve ser um valor inteiro.',
            'num_bathrooms.min' => 'O número de banheiros deve ser pelo menos 1.',
            'num_suites.required' => 'O número de suítes é obrigatório.',
            'num_suites.integer' => 'O número de suítes deve ser um valor inteiro.',
            'num_suites.min' => 'O número de suítes não pode ser negativo.',
            'num_garages.required' => 'O número de garagens é obrigatório.',
            'num_garages.integer' => 'O número de garagens deve ser um valor inteiro.',
            'num_garages.min' => 'O número de garagens não pode ser negativo.',
            'size.required' => 'O tamanho da casa é obrigatório.',
            'size.numeric' => 'O tamanho da casa deve ser um valor numérico.',
            'size.min' => 'O tamanho da casa não pode ser negativo.',
            'value.required' => 'O valor da casa é obrigatório.',
            'value.numeric' => 'O valor da casa deve ser um valor numérico.',
            'value.min' => 'O valor da casa não pode ser negativo.',
            'main_image.image' => 'O arquivo deve ser uma imagem.',
            'main_image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'main_image.max' => 'O tamanho máximo da imagem é de :max kilobytes.',
            'available.required' => 'A disponibilidade da casa é obrigatória.',
            'available.boolean' => 'O valor de disponibilidade deve ser verdadeiro ou falso.',
        ];
    }
}
