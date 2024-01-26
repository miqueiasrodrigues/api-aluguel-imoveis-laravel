<?php

namespace App\Http\Requests\allocation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllocationRequest extends FormRequest
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
            'house_id' => 'nullable|exists:houses,id',
            'allocation_date' => 'nullable|date',
            'departure_time' => 'nullable|date',
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
            'house_id.exists' => 'A casa especificada não existe.',
            'allocation_date.date' => 'A data de alocação deve ser uma data válida.',
            'departure_time.date' => 'A data de saída deve ser uma data válida.',
        ];
    }
}
