@extends('layouts.app')

@section('title', 'Nova Release')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nova Release
                </h1>
                <a href="{{ route('admin.releases.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Corrija os seguintes erros:</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.releases.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @include('admin.releases.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dicas -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info">
                <h5 class="alert-heading">💡 Dicas para preencher:</h5>
                <ul class="mb-0">
                    <li>• O código da release deve ser único (ex: RW-2024-001)</li>
                    <li>• A data de liberação determina automaticamente ano, mês e semana</li>
                    <li>• Releases em "Rascunho" só são visíveis para você</li>
                    <li>• Apenas administradores podem alterar o status para "Aprovado"</li>
                    <li>• Imagens devem ter no máximo 2MB</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection