@extends('layouts.app')

@section('title', 'Releases')

@section('content')
    <div class="container-fluid px-4 py-4">
        <!-- Cabeçalho -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">
                            <i class="fas fa-rocket me-2 text-primary"></i>
                            Releases Documentadas
                        </h2>
                        @if(request('search'))
                            <p class="text-muted mb-0">
                                <i class="fas fa-search me-1"></i>
                                Resultados para: <strong>"{{ request('search') }}"</strong>
                            </p>
                        @endif
                    </div>
                    
                    <div class="d-flex gap-2">
                        @if(request()->anyFilled(['ano', 'mes', 'semana', 'search']))
                            <a href="{{ route('releases.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Limpar Filtros
                            </a>
                        @endif
                        
                        @auth
                            @can('access-analista')
                                <a href="{{ route('admin.releases.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nova Release
                                </a>
                            @endcan
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros Ativos -->
        @if(request('ano') || request('mes') || request('semana'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center">
                        <i class="fas fa-filter me-3 fs-5"></i>
                        <div class="flex-grow-1">
                            <strong class="me-2">Filtros ativos:</strong>
                            @if(request('ano'))
                                <span class="badge bg-primary me-2">
                                    <i class="far fa-calendar me-1"></i>Ano: {{ request('ano') }}
                                </span>
                            @endif
                            @if(request('mes'))
                                @php
                                    $mesesNomes = [
                                        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                                        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                                        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                                    ];
                                    $mesNome = $mesesNomes[request('mes')] ?? 'Mês ' . request('mes');
                                @endphp
                                <span class="badge bg-success me-2">
                                    <i class="far fa-calendar-alt me-1"></i>{{ $mesNome }}
                                </span>
                            @endif
                            @if(request('semana'))
                                <span class="badge bg-warning text-dark me-2">
                                    <i class="fas fa-calendar-week me-1"></i>Semana {{ request('semana') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Lista de Releases -->
        @if($releases->count() > 0)
            <div class="row">
                @foreach($releases as $release)
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <!-- Header do Card -->
                            <div class="card-header bg-white border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-0">
                                            <span class="badge bg-primary me-2">{{ $release->release_codigo }}</span>
                                            {{ $release->numero_chamado }}
                                        </h5>
                                    </div>
                                    <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                        <span class="badge {{ $release->tipo_chamada == 'Correção' ? 'bg-danger' : 'bg-success' }} me-2">
                                            <i class="fas {{ $release->tipo_chamada == 'Correção' ? 'fa-bug' : 'fa-star' }} me-1"></i>
                                            {{ $release->tipo_chamada }}
                                        </span>
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-circle-notch me-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <!-- Grid de Informações Principais -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <label class="text-muted small mb-1">
                                                <i class="fas fa-user me-1"></i>Agente Responsável
                                            </label>
                                            <div class="fw-semibold">{{ $release->agente }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <label class="text-muted small mb-1">
                                                <i class="fas fa-calendar-check me-1"></i>Data de Liberação
                                            </label>
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <label class="text-muted small mb-1">
                                                <i class="fas fa-calendar-week me-1"></i>Período
                                            </label>
                                            <div class="fw-semibold">
                                                Semana {{ $release->semana }} - {{ $release->mes }}/{{ $release->ano }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Descrição do Chamado -->
                                <div class="mb-4">
                                    <label class="text-muted small mb-2">
                                        <i class="fas fa-align-left me-1"></i>Descrição do Chamado
                                    </label>
                                    <div class="p-3 bg-light rounded">
                                        <p class="mb-0">{{ $release->descricao }}</p>
                                    </div>
                                </div>

                                <!-- Área/Sistema -->
                                <div class="mb-4">
                                    <label class="text-muted small mb-2">
                                        <i class="fas fa-cogs me-1"></i>Área / Sistema
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-dark me-2">Teorema WMS</span>
                                        <i class="fas fa-chevron-right text-muted small mx-1"></i>
                                        <span class="text-muted">Configuração</span>
                                    </div>
                                </div>
                                
                                <!-- Descrição da Correção -->
                                <div class="mb-4">
                                    <label class="text-muted small mb-2">
                                        <i class="fas fa-tools me-1"></i>Descrição da Correção
                                    </label>
                                    <div class="p-3 border-start border-primary border-4 bg-light rounded">
                                        <p class="mb-0">{{ $release->descricao_correcao }}</p>
                                    </div>
                                </div>
                                
                                <!-- Imagem -->
                                @if($release->imagem)
                                    <div class="mb-4">
                                        <label class="text-muted small mb-2">
                                            <i class="fas fa-image me-1"></i>Evidência Visual
                                        </label>
                                        <div class="text-center p-3 bg-light rounded">
                                            <a href="{{ asset('storage/' . $release->imagem) }}" 
                                               target="_blank" 
                                               class="d-inline-block position-relative image-zoom">
                                                <img src="{{ asset('storage/' . $release->imagem) }}" 
                                                     alt="Evidência da release" 
                                                     class="img-fluid rounded shadow-sm" 
                                                     style="max-height: 300px; cursor: pointer;">
                                                <div class="image-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </a>
                                            <p class="text-muted small mt-2 mb-0">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Clique para ampliar
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Documentação -->
                                <div class="mb-3">
                                    <label class="text-muted small mb-2">
                                        <i class="fas fa-book me-1"></i>Documentação
                                    </label>
                                    @if($release->link_manual)
                                        <div class="alert alert-primary border-0 mb-0 d-flex align-items-center">
                                            <i class="fas fa-file-alt fs-4 me-3"></i>
                                            <div class="flex-grow-1">
                                                <strong>Manual de Configuração e Otimização de Estoques</strong>
                                                <p class="mb-0 small text-muted">Documentação técnica completa</p>
                                            </div>
                                            <a href="{{ $release->link_manual }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-external-link-alt me-1"></i> Acessar
                                            </a>
                                        </div>
                                    @else
                                        <div class="alert alert-light border mb-0 d-flex align-items-center">
                                            <i class="fas fa-info-circle text-muted fs-5 me-3"></i>
                                            <span class="text-muted">Nenhuma documentação disponível</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Footer do Card -->
                            <div class="card-footer bg-white border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        <i class="far fa-user-circle me-1"></i>
                                        Documentado por <strong>{{ $release->user->name ?? 'Usuário' }}</strong>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('releases.show', $release) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Ver Detalhes
                                        </a>
                                        @auth
                                            @if(auth()->user()->id == $release->user_id || auth()->user()->isAdmin())
                                                <a href="{{ route('admin.releases.edit', $release) }}" 
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit me-1"></i> Editar
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4">
                {{ $releases->links() }}
            </div>
        @else
            <!-- Estado Vazio -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-inbox text-muted mb-4" style="font-size: 5rem; opacity: 0.3;"></i>
                                <h3 class="text-muted mb-3">Nenhuma release encontrada</h3>
                                <p class="text-muted mb-4">
                                    @if(request()->anyFilled(['ano', 'mes', 'semana', 'search']))
                                        Não há releases correspondentes aos filtros aplicados.<br>
                                        Tente ajustar os critérios de busca.
                                    @else
                                        Não há releases documentadas no momento.<br>
                                        Comece criando sua primeira release!
                                    @endif
                                </p>
                                <a href="{{ route('releases.index') }}" class="btn btn-primary">
                                    <i class="fas fa-redo me-1"></i> Ver Todas as Releases
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- CSS Customizado -->
    <style>
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .info-box {
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 0.375rem;
            height: 100%;
        }
        
        .image-zoom {
            position: relative;
            overflow: hidden;
            border-radius: 0.375rem;
        }
        
        .image-zoom:hover .image-overlay {
            opacity: 1;
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-size: 2rem;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.4em 0.8em;
        }
        
        .empty-state {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .border-start.border-primary {
            border-width: 4px !important;
        }
    </style>
@endsection