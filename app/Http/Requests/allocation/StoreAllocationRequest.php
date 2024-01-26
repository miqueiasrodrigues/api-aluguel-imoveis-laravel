<?php

namespace App\Http\Requests\allocation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllocationRequest extends FormRequest
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
            'house_id' => 'required|exists:houses,id',
            'allocation_date' => 'required|date',
            'departure_time' => 'required|date',
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
            'house_id.required' => 'O ID da casa é obrigatório.',
            'house_id.exists' => 'A casa especificada não existe.',
            'allocation_date.required' => 'A data de alocação é obrigatória.',
            'allocation_date.date' => 'A data de alocação deve ser uma data válida.',
            'departure_time.required' => 'A data de saída é obrigatória.',
            'departure_time.date' => 'A data de saída deve ser uma data válida.',
        ];
    }
}
