@extends('layouts.app')

@section('title', 'Editar Release')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Editar Release: {{ $release->release_codigo }}
                </h1>
                <a href="{{ route('admin.releases.show', $release) }}" class="btn btn-outline-secondary">
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

                    <form action="{{ route('admin.releases.update', $release) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        @include('admin.releases.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection