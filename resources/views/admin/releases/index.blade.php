@extends('layouts.app')

@section('title', 'Gerenciar Releases')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-cog me-2"></i>
                    Gerenciar Releases
                </h1>
                <a href="{{ route('admin.releases.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Nova Release
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros e busca -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.releases.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Buscar por número, código, agente..."
                           class="form-control">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Todos os status</option>
                        <option value="rascunho" {{ request('status') == 'rascunho' ? 'selected' : '' }}>Rascunho</option>
                        <option value="em_analise" {{ request('status') == 'em_analise' ? 'selected' : '' }}>Em Análise</option>
                        <option value="aprovado" {{ request('status') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de releases -->
    <div class="card">
        <div class="card-body">
            @if($releases->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Chamado</th>
                                <th>Agente</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($releases as $release)
                                <tr>
                                    <td>{{ $release->release_codigo }}</td>
                                    <td>{{ $release->numero_chamado }}</td>
                                    <td>{{ $release->agente }}</td>
                                    <td>
                                        <span class="badge bg-{{ $release->status == 'aprovado' ? 'success' : ($release->status == 'em_analise' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.releases.show', $release) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.releases.edit', $release) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginação -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $releases->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Nenhuma release encontrada</h4>
                    <p class="text-muted">Comece criando sua primeira release.</p>
                    <a href="{{ route('admin.releases.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Criar Primeira Release
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection