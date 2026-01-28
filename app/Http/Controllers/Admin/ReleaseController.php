<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReleaseRequest;
use App\Http\Requests\UpdateReleaseRequest;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReleaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Release::with('user')->latest();
        
        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // No método index()
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_chamado', 'like', "%{$search}%")
                ->orWhere('release_codigo', 'like', "%{$search}%")
                ->orWhere('agente', 'like', "%{$search}%")
                ->orWhere('descricao', 'like', "%{$search}%")
                ->orWhere('descricao_correcao', 'like', "%{$search}%")
                ->orWhere('tipo_chamada', 'like', "%{$search}%");
            });
        }
        
        $releases = $query->paginate(15);
        
        return view('admin.releases.index', compact('releases'));
    }
    
    public function create()
    {
        return view('admin.releases.create');
    }
    
    public function store(StoreReleaseRequest $request)
    {
        $data = $request->validated();
        
        // Upload da imagem
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('releases', 'public');
            $data['imagem'] = $path;
        }
        
        // Adicionar user_id
        $data['user_id'] = auth()->id();
        
        Release::create($data);
        
        return redirect()->route('admin.releases.index')
            ->with('success', 'Release criada com sucesso!');
    }
    
    public function show(Release $release)
    {
        return view('admin.releases.show', compact('release'));
    }
    
    public function edit(Release $release)
    {
        return view('admin.releases.edit', compact('release'));
    }
    
    public function update(UpdateReleaseRequest $request, Release $release)
    {
        $data = $request->validated();
        
        // Upload da nova imagem (se fornecida)
        if ($request->hasFile('imagem')) {
            // Excluir imagem antiga se existir
            if ($release->imagem) {
                Storage::disk('public')->delete($release->imagem);
            }
            
            $path = $request->file('imagem')->store('releases', 'public');
            $data['imagem'] = $path;
        }
        
        $release->update($data);
        
        return redirect()->route('admin.releases.index')
            ->with('success', 'Release atualizada com sucesso!');
    }
    
    public function destroy(Release $release)
    {
        // Excluir imagem se existir
        if ($release->imagem) {
            Storage::disk('public')->delete($release->imagem);
        }
        
        $release->delete();
        
        return redirect()->route('admin.releases.index')
            ->with('success', 'Release excluída com sucesso!');
    }
    
    public function alterarStatus(Release $release, Request $request)
    {
        $request->validate([
            'status' => 'required|in:rascunho,em_analise,aprovado'
        ]);
        
        $release->update(['status' => $request->status]);
        
        return back()->with('success', 'Status alterado com sucesso!');
    }
}