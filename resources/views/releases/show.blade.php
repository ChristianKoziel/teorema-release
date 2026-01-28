<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalhes da Release
            </h2>
            <div class="flex space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold release-status-{{ $release->status }}">
                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                </span>
                @if($release->tipo_chamada == 'Correção')
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                        🔧 Correção
                    </span>
                @else
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                        🚀 Melhoria
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Menu Lateral -->
                <div class="lg:col-span-1">
                    <x-menu-lateral />
                </div>
                
                <!-- Conteúdo Principal -->
                <div class="lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- Cabeçalho -->
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $release->release_codigo }}</h1>
                                    <p class="text-gray-600">Criado por {{ $release->user->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Data de Liberação</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Semana {{ $release->semana }} • {{ $release->mes }}/{{ $release->ano }}
                                    </p>
                                </div>
                            </div>

                            <!-- Informações Principais -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Número do Chamado</h3>
                                        <p class="mt-1 text-lg text-gray-900">{{ $release->numero_chamado }}</p>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Agente Responsável</h3>
                                        <p class="mt-1 text-lg text-gray-900">{{ $release->agente }}</p>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Tipo de Chamada</h3>
                                        <div class="mt-1">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                {{ $release->tipo_chamada == 'Correção' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $release->tipo_chamada }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Link do Manual</h3>
                                        @if($release->link_manual)
                                            <a href="{{ $release->link_manual }}" 
                                               target="_blank"
                                               class="mt-1 text-blue-600 hover:text-blue-800 flex items-center">
                                                🔗 {{ Str::limit($release->link_manual, 40) }}
                                            </a>
                                        @else
                                            <p class="mt-1 text-gray-500 italic">Nenhum link fornecido</p>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                        <div class="mt-1">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold release-status-{{ $release->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Criado em</h3>
                                        <p class="mt-1 text-gray-900">
                                            {{ \Carbon\Carbon::parse($release->created_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrições -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Descrição</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-700 whitespace-pre-line">{{ $release->descricao }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Descrição da Correção/Melhoria</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-700 whitespace-pre-line">{{ $release->descricao_correcao }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagem -->
                            @if($release->imagem)
                                <div class="mt-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Imagem</h3>
                                    <div class="border rounded-lg overflow-hidden max-w-2xl">
                                        <img src="{{ asset('storage/' . $release->imagem) }}" 
                                             alt="Imagem da release {{ $release->release_codigo }}"
                                             class="w-full h-auto">
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Clique na imagem para ampliar
                                    </p>
                                </div>
                            @endif

                            <!-- Botões de Ação -->
                            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between">
                                <div>
                                    <a href="{{ route('releases.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        ← Voltar
                                    </a>
                                </div>
                                
                                @auth
                                    @if(auth()->user()->id == $release->user_id || auth()->user()->isAdmin())
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.releases.edit', $release) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                ✏️ Editar
                                            </a>
                                            
                                            @if(auth()->user()->isAdmin())
                                                <form action="{{ route('admin.releases.destroy', $release) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Tem certeza que deseja excluir esta release?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        🗑️ Excluir
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>