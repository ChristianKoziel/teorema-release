@extends('layouts.app')

@section('title', 'Detalhes da Release')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Detalhes da Release: {{ $release->release_codigo }}
                </h1>
                <div>
                    <a href="{{ route('admin.releases.edit', $release) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                    <a href="{{ route('admin.releases.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Badges de status -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-{{ $release->status == 'aprovado' ? 'success' : ($release->status == 'em_analise' ? 'warning' : 'secondary') }} fs-6">
                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                </span>
                <span class="badge bg-{{ $release->tipo_chamada == 'Correção' ? 'danger' : 'success' }} fs-6">
                    {{ $release->tipo_chamada }}
                </span>
                <span class="badge bg-info fs-6">
                    Semana {{ $release->semana }} - {{ $release->mes }}/{{ $release->ano }}
                </span>
                @if($release->user)
                    <span class="badge bg-dark fs-6">
                        <i class="fas fa-user me-1"></i> {{ $release->user->name }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Informações principais -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informações da Chamada
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                    <td>{{ $release->descricao }}</td>
                                    <td><span class="badge bg-primary fs-6">{{ $release->release_codigo }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Descrições -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-align-left me-2"></i>
                                Descrição
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $release->descricao }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-tools me-2"></i>
                                Descrição da Correção/Melhoria
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $release->descricao_correcao }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar com informações adicionais -->
        <div class="col-md-4">
            <!-- Link do Manual -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-book me-2"></i>
                        Documentação
                    </h5>
                </div>
                <div class="card-body">
                    @if($release->link_manual)
                        <div class="alert alert-primary">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-external-link-alt fa-2x me-3"></i>
                                <div>
                                    <strong>Manual de Configuração</strong>
                                    <div class="mt-1">
                                        <a href="{{ $release->link_manual }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-external-link-alt me-1"></i> Acessar Link
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-secondary">
                            <i class="fas fa-info-circle me-2"></i>
                            Nenhum link de documentação disponível.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Imagem -->
            @if($release->imagem)
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-image me-2"></i>
                            Tela_01
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ asset('storage/' . $release->imagem) }}" target="_blank">
                            <img src="{{ asset('storage/' . $release->imagem) }}" 
                                 alt="Imagem da release" 
                                 class="img-fluid rounded border"
                                 style="max-height: 300px;">
                        </a>
                        <p class="text-muted small mt-2">
                            <i class="fas fa-mouse-pointer me-1"></i>
                            Clique na imagem para ampliar
                        </p>
                    </div>
                </div>
            @endif

            <!-- Ações administrativas -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-cog me-2"></i>
                        Ações Administrativas
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Alterar Status -->
                    <form action="{{ route('admin.releases.status', $release) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Alterar Status</strong></label>
                            <select name="status" id="status" class="form-select">
                                <option value="rascunho" {{ $release->status == 'rascunho' ? 'selected' : '' }}>📝 Rascunho</option>
                                <option value="em_analise" {{ $release->status == 'em_analise' ? 'selected' : '' }}>🔍 Em Análise</option>
                                <option value="aprovado" {{ $release->status == 'aprovado' ? 'selected' : '' }}>✅ Aprovado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sync-alt me-1"></i> Alterar Status
                        </button>
                    </form>

                    <!-- Excluir Release -->
                    <form action="{{ route('admin.releases.destroy', $release) }}" method="POST" 
                          onsubmit="return confirm('Tem certeza que deseja excluir esta release? Esta ação não pode ser desfeita.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash-alt me-1"></i> Excluir Release
                        </button>
                    </form>

                    <!-- Metadados -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="text-muted mb-2">Metadados</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-1">
                                <i class="far fa-calendar me-2"></i>
                                <strong>Criado em:</strong> 
                                {{ \Carbon\Carbon::parse($release->created_at)->format('d/m/Y H:i') }}
                            </li>
                            <li class="mb-1">
                                <i class="far fa-calendar-check me-2"></i>
                                <strong>Atualizado em:</strong> 
                                {{ \Carbon\Carbon::parse($release->updated_at)->format('d/m/Y H:i') }}
                            </li>
                            <li>
                                <i class="fas fa-id-badge me-2"></i>
                                <strong>ID:</strong> {{ $release->id }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection