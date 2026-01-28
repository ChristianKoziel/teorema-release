<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Release extends Model
{
    protected $fillable = [
        'numero_chamado',
        'agente',
        'descricao',
        'release_codigo',
        'data_liberacao',
        'tipo_chamada',
        'descricao_correcao',
        'imagem',
        'link_manual',
        'ano',
        'mes',
        'semana',
        'status',
        'user_id',
    ];

    protected $casts = [
        'data_liberacao' => 'date',
        'ano' => 'integer',
        'mes' => 'integer',
        'semana' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Escopo para filtrar por ano, mês e semana
    public function scopePorPeriodo($query, $ano = null, $mes = null, $semana = null)
    {
        if ($ano) {
            $query->where('ano', $ano);
        }
        
        if ($mes) {
            $query->where('mes', $mes);
        }
        
        if ($semana) {
            $query->where('semana', $semana);
        }
        
        return $query;
    }

    // Escopo para releases aprovadas
    public function scopeAprovadas($query)
    {
        return $query->where('status', 'aprovado');
    }

    // Escopo para releases do usuário atual
    public function scopeDoUsuario($query)
    {
        return $query->where('user_id', auth()->id());
    }
}