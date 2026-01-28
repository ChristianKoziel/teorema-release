<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReleaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function prepareForValidation()
    {
        // Garantir que mês e semana sejam inteiros
        $this->merge([
            'mes' => (int) $this->mes,
            'semana' => (int) $this->semana,
            'ano' => (int) $this->ano,
        ]);
    }

    public function rules(): array
    {
        return [
            'numero_chamado' => ['required', 'string', 'max:50'],
            'agente' => ['required', 'string', 'max:100'],
            'descricao' => ['required', 'string', 'max:500'],
            'release_codigo' => ['required', 'string', 'max:50'],
            'data_liberacao' => ['required', 'date'],
            'tipo_chamada' => ['required', Rule::in(['Correção', 'Melhoria'])],
            'descricao_correcao' => ['required', 'string'],
            'imagem' => ['nullable', 'image', 'max:2048'],
            'link_manual' => ['nullable', 'url'],
            'ano' => ['required', 'integer', 'min:2023', 'max:2030'],
            'mes' => ['required', 'integer', 'min:1', 'max:12'],
            'semana' => ['required', 'integer', 'min:1', 'max:53'],
            'status' => ['required', Rule::in(['rascunho', 'em_analise', 'aprovado'])],
        ];
    }

    public function messages(): array
    {
        return [
            'imagem.max' => 'A imagem não pode ser maior que 2MB.',
            'ano.min' => 'O ano deve ser a partir de 2023.',
            'semana.max' => 'A semana não pode ser maior que 53.',
        ];
    }
}