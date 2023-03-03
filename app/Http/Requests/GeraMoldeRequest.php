<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeraMoldeRequest extends FormRequest
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
            'altura' => 'required',
            'quantidade_gomo' => 'required',
            'bainha' => 'required',
            'tipo' => 'required'
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
            'altura.required' => 'Altura é obrigatório',
            'quantidade_gomo.required' => 'Quantidades de gomos é obrigatório',
            'bainha.required' => 'Bainha é obrigatório',
            'tipo.required' => 'Tipo do molde é obrigatório'
        ];
    }
}
