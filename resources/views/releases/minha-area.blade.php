@extends('layouts.app')

@section('title', 'Minha Área')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-user me-2"></i>
                    Minha Área
                </h1>
                @can('access-analista')
                    <a href="{{ route('admin.releases.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Nova Release
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $releases->total() }}</h3>
                    <p class="card-text text-muted mb-0">Total</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title text-warning">
                        {{ auth()->user()->releases()->where('status', 'rascunho')->count() }}
                    </h3>
                    <p class="card-text text-muted mb-0">Rascunho</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title text-info">
                        {{ auth()->user()->releases()->where('status', 'em_analise')->count() }}
                    </h3>
                    <p class="card-text text-muted mb-0">Em Análise</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title text-success">
                        {{ auth()->user()->releases()->where('status', 'aprovado')->count() }}
                    </h3>
                    <p class="card-text text-muted mb-0">Aprovadas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Releases -->
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
                                <th>Tipo</th>
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
                                    <td>
                                        <span class="badge bg-{{ $release->tipo_chamada == 'Correção' ? 'danger' : 'success' }}">
                                            {{ $release->tipo_chamada }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('releases.show', $release) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($release->status !== 'aprovado' || auth()->user()->isAdmin())
                                            <a href="{{ route('admin.releases.edit', $release) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
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
                    <h4 class="text-muted">Você ainda não criou nenhuma release</h4>
                    <p class="text-muted">Comece criando sua primeira release.</p>
                    @can('access-analista')
                        <a href="{{ route('admin.releases.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Criar Primeira Release
                        </a>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
@endsection