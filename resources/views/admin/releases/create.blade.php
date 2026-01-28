<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nova Release
            </h2>
            <a href="{{ route('admin.releases.index') }}" 
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Voltar para lista
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <h3 class="text-red-800 font-medium mb-2">Corrija os seguintes erros:</h3>
                            <ul class="list-disc list-inside text-red-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.releases.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @include('admin.releases.partials.form')
                    </form>
                </div>
            </div>
            
            <!-- Dicas -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-medium text-blue-800 mb-2">💡 Dicas para preencher:</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• O código da release deve ser único (ex: RW-2024-001)</li>
                    <li>• A data de liberação determina automaticamente ano, mês e semana</li>
                    <li>• Releases em "Rascunho" só são visíveis para você</li>
                    <li>• Apenas administradores podem alterar o status para "Aprovado"</li>
                    <li>• Imagens devem ter no máximo 2MB</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>