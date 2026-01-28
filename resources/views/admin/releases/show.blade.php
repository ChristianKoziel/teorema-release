<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalhes da Release (Admin)
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.releases.edit', $release) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700">
                    ✏️ Editar
                </a>
                <a href="{{ route('admin.releases.index') }}" 
                   class="text-sm text-gray-600 hover:text-gray-900">
                    ← Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Info -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $release->release_codigo }}</h1>
                            <div class="flex items-center space-x-3 mt-2">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold release-status-{{ $release->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $release->tipo_chamada == 'Correção' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $release->tipo_chamada }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                            <p class="text-sm text-gray-500">Criado por</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $release->user->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($release->created_at)->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Chamado</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $release->numero_chamado }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Agente</p>
                            <p class="text-lg font-semibold text-blue-900">{{ $release->agente }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm text-green-600">Data Liberação</p>
                            <p class="text-lg font-semibold text-green-900">
                                {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-sm text-purple-600">Período</p>
                            <p class="text-lg font-semibold text-purple-900">
                                S{{ $release->semana }} - {{ $release->mes }}/{{ $release->ano }}
                            </p>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left Column -->
                        <div class="md:col-span-2 space-y-6">
                            <!-- Description -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Descrição</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $release->descricao }}</p>
                                </div>
                            </div>
                            
                            <!-- Correction Description -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Descrição da Correção/Melhoria</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $release->descricao_correcao }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Manual Link -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Link do Manual</h3>
                                @if($release->link_manual)
                                    <a href="{{ $release->link_manual }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200">
                                        🔗 Acessar Manual
                                    </a>
                                @else
                                    <p class="text-gray-500 italic">Nenhum link fornecido</p>
                                @endif
                            </div>
                            
                            <!-- Image -->
                            @if($release->imagem)
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Imagem</h3>
                                    <div class="border rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $release->imagem) }}" 
                                             alt="Imagem da release"
                                             class="w-full h-auto">
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Admin Actions -->
                            @if(auth()->user()->isAdmin())
                                <div class="pt-4 border-t">
                                    <h3 class="text-lg font-medium text-gray-900 mb-3">Alterar Status</h3>
                                    <form action="{{ route('admin.releases.status', $release) }}" 
                                          method="POST" 
                                          class="space-y-3">
                                        @csrf
                                        <div class="flex space-x-2">
                                            <select name="status" 
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="rascunho" {{ $release->status == 'rascunho' ? 'selected' : '' }}>Rascunho</option>
                                                <option value="em_analise" {{ $release->status == 'em_analise' ? 'selected' : '' }}>Em Análise</option>
                                                <option value="aprovado" {{ $release->status == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                                            </select>
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                Alterar
                                            </button>
                                        </div>
                                    </form>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.releases.destroy', $release) }}" 
                                          method="POST" 
                                          class="mt-4"
                                          onsubmit="return confirm('Excluir permanentemente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                            🗑️ Excluir Permanentemente
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>