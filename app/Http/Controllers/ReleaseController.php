<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseController extends Controller
{
    public function index(Request $request)
    {
        $ano = $request->query('ano');
        $mes = $request->query('mes');
        $semana = $request->query('semana');
        $search = $request->query('search');
        
        // Converter para inteiros para evitar problemas
        $ano = $ano ? (int)$ano : null;
        $mes = $mes ? (int)$mes : null;
        $semana = $semana ? (int)$semana : null;
        
        $query = Release::aprovadas()->latest();
        
        // Aplicar filtros de período
        if ($ano) {
            $query->where('ano', $ano);
        }
        
        if ($mes) {
            $query->where('mes', $mes);
        }
        
        if ($semana) {
            $query->where('semana', $semana);
        }
        
        // Aplicar busca por palavras-chave
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('numero_chamado', 'like', "%{$search}%")
                  ->orWhere('agente', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('release_codigo', 'like', "%{$search}%")
                  ->orWhere('descricao_correcao', 'like', "%{$search}%")
                  ->orWhere('tipo_chamada', 'like', "%{$search}%");
            });
        }
        
        $releases = $query->paginate(10);
        
        // Obter anos, meses e semanas para o menu
        $anos = Release::aprovadas()->distinct()->pluck('ano')->sort();
        $meses = $ano ? Release::aprovadas()->where('ano', $ano)->distinct()->pluck('mes')->sort() : collect();
        $semanas = ($ano && $mes) ? Release::aprovadas()
            ->where('ano', $ano)
            ->where('mes', $mes)
            ->distinct()
            ->pluck('semana')
            ->sort() : collect();
        
        return view('releases.index', compact('releases', 'anos', 'meses', 'semanas', 'ano', 'mes', 'semana', 'search'));
    }
    
    public function show(Release $release)
    {
        // Somente visualizar se estiver aprovada ou se for do usuário
        if ($release->status !== 'aprovado' && $release->user_id !== Auth::id()) {
            abort(403, 'Esta release não está disponível para visualização.');
        }
        
        return view('releases.show', compact('release'));
    }
    
    public function minhaArea(Request $request)
    {
        $search = $request->query('search');
        
        $query = Release::where('user_id', Auth::id())->latest();
        
        // Aplicar busca na "Minha Área"
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('numero_chamado', 'like', "%{$search}%")
                  ->orWhere('agente', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('release_codigo', 'like', "%{$search}%")
                  ->orWhere('descricao_correcao', 'like', "%{$search}%")
                  ->orWhere('tipo_chamada', 'like', "%{$search}%");
            });
        }
        
        $releases = $query->paginate(10);
        
        return view('releases.minha-area', compact('releases', 'search'));
    }
}