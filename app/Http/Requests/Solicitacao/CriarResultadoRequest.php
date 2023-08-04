<?php

namespace App\Http\Requests\Solicitacao;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class CriarResultadoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'planejamento_id' => 'required',
            'abate' => 'required_if:abate_radio,==,true',
            'destino_animais' => 'required',
            'justificativa_metodos' => 'required',
            'resumo_procedimento' => 'required',
            'outras_infos' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'planejamento_id.required'  => 'Necessária a criação de um planejamento',
            '*.required'  => 'O :attribute é obrigatório',
            '*.required_if'  => 'O :attribute é obrigatório',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Falha na validação',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
