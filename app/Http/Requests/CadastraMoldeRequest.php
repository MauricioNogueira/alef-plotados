<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastraMoldeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'circunferencia_base' => 'required',
            'distancia_base' => 'required',
            'escala' => 'required',
            'nome' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'circunferencia_base.required' => 'Circunferência base é obrigatório',
            'distancia_base.required' => 'Distância base é obrigatório',
            'escala.required' => 'Tipo de escala é obrigatório',
            'nome.required' => 'Nome é obrigatório',
        ];
    }
}
