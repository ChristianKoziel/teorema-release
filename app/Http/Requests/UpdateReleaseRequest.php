<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReleaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function prepareForValidation()
    {
        // Garantir que mês e semana sejam inteiros
        if ($this->has('mes')) {
            $this->merge(['mes' => (int) $this->mes]);
        }
        if ($this->has('semana')) {
            $this->merge(['semana' => (int) $this->semana]);
        }
        if ($this->has('ano')) {
            $this->merge(['ano' => (int) $this->ano]);
        }
    }

    public function rules(): array
    {
        return [
            'numero_chamado' => ['sometimes', 'string', 'max:50'],
            'agente' => ['sometimes', 'string', 'max:100'],
            'descricao' => ['sometimes', 'string', 'max:500'],
            'release_codigo' => ['sometimes', 'string', 'max:50'],
            'data_liberacao' => ['sometimes', 'date'],
            'tipo_chamada' => ['sometimes', Rule::in(['Correção', 'Melhoria'])],
            'descricao_correcao' => ['sometimes', 'string'],
            'imagem' => ['nullable', 'image', 'max:2048'],
            'link_manual' => ['nullable', 'url'],
            'ano' => ['sometimes', 'integer', 'min:2023', 'max:2030'],
            'mes' => ['sometimes', 'integer', 'min:1', 'max:12'],
            'semana' => ['sometimes', 'integer', 'min:1', 'max:53'],
            'status' => ['sometimes', Rule::in(['rascunho', 'em_analise', 'aprovado'])],
        ];
    }
}