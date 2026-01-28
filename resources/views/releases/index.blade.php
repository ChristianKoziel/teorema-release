<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Releases Aprovadas
        </h2>
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
                    <!-- Barra de Pesquisa -->
                    <div class="mb-6 bg-white rounded-lg shadow p-4">
                        <form action="{{ route('releases.index') }}" method="GET" class="flex">
                            <div class="flex-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                    name="search" 
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Pesquisar releases por palavra-chave, número, agente, descrição..."
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="ml-3">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    🔍 Buscar
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('releases.index') }}" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-2">
                                        🗑️ Limpar
                                    </a>
                                @endif
                            </div>
                        </form>
                        
                        <!-- Dicas de busca -->
                        @if(!request('search'))
                            <div class="mt-3 text-sm text-gray-500">
                                <span class="font-medium">💡 Dicas:</span> 
                                Busque por número do chamado, nome do agente, descrição, código da release ou tipo (Correção/Melhoria)
                            </div>
                        @else
                            <div class="mt-3 flex items-center text-sm text-blue-600">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>
                                    {{ $releases->total() }} resultado(s) para "{{ request('search') }}"
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- Filtros Ativos -->
                            <!-- Filtros Ativos -->
                            @if($ano || $mes || $semana)
                                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                                    <h3 class="font-medium text-blue-800 mb-2">Filtros aplicados:</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @if($ano)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                                Ano: {{ $ano }}
                                            </span>
                                        @endif
                                        @if($mes)
                                            @php
                                                $mesInt = (int)$mes;
                                                $mesNome = \Carbon\Carbon::create()->month($mesInt)->locale('pt_BR')->monthName;
                                            @endphp
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                                Mês: {{ $mesNome }}
                                            </span>
                                        @endif
                                        @if($semana)
                                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                                Semana: {{ $semana }}
                                            </span>
                                        @endif
                                        <a href="{{ route('releases.index') }}" 
                                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300">
                                            ✕ Limpar filtros
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Estatísticas -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                                            <span class="text-blue-600">📊</span>
                                        </div>
                                        <div>
                                            <p class="text-sm text-blue-600">Total de Releases</p>
                                            <p class="text-2xl font-bold text-blue-800">{{ $releases->total() }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 p-3 rounded-full mr-4">
                                            <span class="text-green-600">✅</span>
                                        </div>
                                        <div>
                                            <p class="text-sm text-green-600">Aprovadas Esta Semana</p>
                                            <p class="text-2xl font-bold text-green-800">
                                                {{ \App\Models\Release::aprovadas()
                                                    ->where('ano', date('Y'))
                                                    ->where('semana', date('W'))
                                                    ->count() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                                            <span class="text-purple-600">📅</span>
                                        </div>
                                        <div>
                                            <p class="text-sm text-purple-600">Anos de Releases</p>
                                            <p class="text-2xl font-bold text-purple-800">{{ $anos->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lista de Releases -->
                            @if($releases->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Release
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Agente
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Data
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tipo
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Ações
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($releases as $release)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $release->release_codigo }}
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    Chamado: {{ $release->numero_chamado }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $release->agente }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            Semana {{ $release->semana }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            {{ $release->tipo_chamada == 'Correção' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                            {{ $release->tipo_chamada }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('releases.show', $release) }}" 
                                                           class="text-blue-600 hover:text-blue-900 mr-3">
                                                            👁️ Ver
                                                        </a>
                                                        @auth
                                                            @if(auth()->user()->id == $release->user_id)
                                                                <a href="{{ route('admin.releases.edit', $release) }}" 
                                                                   class="text-yellow-600 hover:text-yellow-900">
                                                                    ✏️ Editar
                                                                </a>
                                                            @endif
                                                        @endauth
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Paginação -->
                                <div class="mt-6">
                                    {{ $releases->links() }}
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="text-gray-400 text-6xl mb-4">📭</div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                                        Nenhuma release encontrada
                                    </h3>
                                    <p class="text-gray-500 mb-6">
                                        @if($ano || $mes || $semana)
                                            Não há releases aprovadas para os filtros aplicados.
                                        @else
                                            Não há releases aprovadas disponíveis no momento.
                                        @endif
                                    </p>
                                    @if($ano || $mes || $semana)
                                        <a href="{{ route('releases.index') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                            Ver todas as releases
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <!-- Ações Rápidas -->
                            @auth
                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Ações Rápidas</h4>
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('releases.minha-area') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                            👤 Minhas Releases
                                        </a>
                                        
                                        @can('access-analista')
                                            <a href="{{ route('admin.releases.create') }}" 
                                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                                ➕ Nova Release
                                            </a>
                                            
                                            <a href="{{ route('admin.releases.index') }}" 
                                               class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition">
                                                ⚙️ Área Administrativa
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>