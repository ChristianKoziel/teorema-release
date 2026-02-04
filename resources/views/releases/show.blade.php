@extends('layouts.app')

@section('title', 'Detalhes da Release')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Detalhes da Release
                </h1>
                <a href="{{ route('releases.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Informações da Chamada
                        </h5>
                        <div>
                            <span class="badge bg-{{ $release->tipo_chamada == 'Correção' ? 'danger' : 'success' }} me-2">
                                {{ $release->tipo_chamada }}
                            </span>
                            <span class="badge bg-{{ $release->status == 'aprovado' ? 'success' : ($release->status == 'em_analise' ? 'warning' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Tabela de informações -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 15%">Chamada</th>
                                    <th style="width: 15%">Agente</th>
                                    <th style="width: 30%">Descrição</th>
                                    <th style="width: 15%">Release</th>
                                    <th style="width: 15%">Liberação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>{{ $release->numero_chamado }}</strong></td>
                                    <td>{{ $release->agente }}</td>
                                    <td>{{ Str::limit($release->descricao, 100) }}</td>
                                    <td><span class="badge bg-primary">{{ $release->release_codigo }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tipo de Chamada -->
                    <div class="alert alert-secondary mb-3">
                        <strong>Tipo de Chamada:</strong> {{ $release->tipo_chamada }}.
                    </div>

                    <!-- Módulo -->
                    <h6 class="mb-3">
                        <i class="fas fa-cogs me-2"></i>
                        Teorema WMS > Configuração
                    </h6>

                    <!-- Descrição da Correção -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Descrição da Correção</h6>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0">{{ $release->descricao_correcao }}</p>
                        </div>
                    </div>

                    <!-- Imagem -->
                    @if($release->imagem)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Tela_01</h6>
                            <div class="text-center">
                                <a href="{{ asset('storage/' . $release->imagem) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $release->imagem) }}" 
                                         alt="Imagem da release" 
                                         class="img-fluid rounded border" 
                                         style="max-height: 300px;">
                                </a>
                                <p class="text-muted small mt-2">Clique na imagem para ampliar</p>
                            </div>
                        </div>
                    @endif

                    <!-- Documentação -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Documentação</h6>
                        @if($release->link_manual)
                            <div class="alert alert-primary">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-book me-2"></i>
                                        <strong>Manual de Configuração e Otimização de Estoques</strong>
                                    </div>
                                    <a href="{{ $release->link_manual }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-external-link-alt me-1"></i> Acessar
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-secondary">
                                <i class="fas fa-info-circle me-2"></i>
                                Nenhum link de documentação disponível.
                            </div>
                        @endif
                    </div>

                    <!-- Metadados -->
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">
                                    <i class="far fa-calendar me-2"></i>
                                    <strong>Período:</strong> Semana {{ $release->semana }} - {{ $release->mes }}/{{ $release->ano }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="far fa-user me-2"></i>
                                    <strong>Responsável:</strong> {{ $release->user->name ?? 'Usuário' }}
                                </p>
                            </div>
                            <div class="col-md-6 text-end">
                                @auth
                                    @if(auth()->user()->id == $release->user_id || auth()->user()->isAdmin())
                                        <a href="{{ route('admin.releases.edit', $release) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-1"></i> Editar
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection