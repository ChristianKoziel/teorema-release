<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Menu Lateral -->
                <div class="lg:col-span-1">
                    <x-menu-lateral />
                </div>
                
                <!-- Conteúdo Principal -->
                <div class="lg:col-span-3">
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
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-gray-100 p-3 rounded-full mr-4">
                                    <span class="text-gray-600">📊</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total de Releases</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $releases->total() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <span class="text-blue-600">📅</span>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-600">Anos Ativos</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ $anos->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-3 rounded-full mr-4">
                                    <span class="text-green-600">✅</span>
                                </div>
                                <div>
                                    <p class="text-sm text-green-600">Última Semana</p>
                                    <p class="text-2xl font-bold text-green-800">
                                        {{ \App\Models\Release::aprovadas()
                                            ->latest('data_liberacao')
                                            ->value('semana') ?? '0' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Releases -->
                    @if($releases->count() > 0)
                        <div class="space-y-6">
                            @foreach($releases as $release)
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:border-blue-300 transition-colors">
                                    <!-- Cabeçalho da Release -->
                                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900">
                                                    Informações da Chamada
                                                </h3>
                                                <p class="text-sm text-gray-600">
                                                    Release: {{ $release->release_codigo }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                                    {{ $release->tipo_chamada == 'Correção' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $release->tipo_chamada }}
                                                </span>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold release-status-{{ $release->status }}">
                                                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tabela de Informações -->
                                    <div class="px-6 py-4">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Chamada</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Agente</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Descrição</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Release</th>
                                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Liberação</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ $release->numero_chamado }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $release->agente }}
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-900">
                                                            {{ Str::limit($release->descricao, 100) }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-blue-600">
                                                            {{ $release->release_codigo }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                                            {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Tipo de Chamada -->
                                        <div class="mt-4 p-3 bg-gray-50 rounded">
                                            <p class="text-sm text-gray-700">
                                                <span class="font-medium">Tipo de Chamada:</span> {{ $release->tipo_chamada }}.
                                            </p>
                                            @if($release->user)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <span class="font-medium">Responsável:</span> {{ $release->user->name }}
                                                </p>
                                            @endif
                                        </div>

                                        <!-- Módulo/Sistema -->
                                        @if(str_contains(strtolower($release->descricao), 'teorema'))
                                            <div class="mt-4">
                                                <p class="text-sm font-medium text-gray-700">Teorema WMS > Configuração</p>
                                            </div>
                                        @endif

                                        <!-- Descrição da Correção -->
                                        <div class="mt-4">
                                            <h4 class="text-md font-medium text-gray-900 mb-2">Descrição da Correção</h4>
                                            <div class="bg-gray-50 p-4 rounded">
                                                <p class="text-gray-700 whitespace-pre-line">{{ $release->descricao_correcao }}</p>
                                            </div>
                                        </div>

                                        <!-- Imagem -->
                                        @if($release->imagem)
                                            <div class="mt-4">
                                                <h4 class="text-md font-medium text-gray-900 mb-2">
                                                    Tela_01
                                                    <span class="text-sm font-normal text-gray-600">(clique para ampliar)</span>
                                                </h4>
                                                <div class="border rounded-lg overflow-hidden max-w-md">
                                                    <a href="{{ asset('storage/' . $release->imagem) }}" 
                                                       target="_blank"
                                                       class="block hover:opacity-90 transition-opacity">
                                                        <img src="{{ asset('storage/' . $release->imagem) }}" 
                                                             alt="Imagem da release {{ $release->release_codigo }}"
                                                             class="w-full h-auto max-h-64 object-contain bg-gray-100">
                                                    </a>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Clique na imagem para visualizar em tamanho real
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Documentação/Link -->
                                        @if($release->link_manual)
                                            <div class="mt-4">
                                                <h4 class="text-md font-medium text-gray-900 mb-2">Documentação</h4>
                                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                                    <a href="{{ $release->link_manual }}" 
                                                       target="_blank"
                                                       class="inline-flex items-center text-blue-700 hover:text-blue-900 font-medium">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Manual de Configuração e Otimização de Estoques
                                                    </a>
                                                    <p class="text-sm text-blue-600 mt-1">
                                                        Clique para acessar a documentação completa
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mt-4">
                                                <h4 class="text-md font-medium text-gray-900 mb-2">Documentação</h4>
                                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                                    <p class="text-gray-600 italic">
                                                        Nenhum link de documentação disponível para esta release.
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Botões de Ação -->
                                        <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center">
                                            <div class="text-sm text-gray-500">
                                                <span class="font-medium">Período:</span> 
                                                Semana {{ $release->semana }} - {{ $release->mes }}/{{ $release->ano }}
                                            </div>
                                            <div class="flex space-x-3">
                                                <a href="{{ route('releases.show', $release) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                                    👁️ Ver Detalhes
                                                </a>
                                                @auth
                                                    @if(auth()->user()->id == $release->user_id || auth()->user()->isAdmin())
                                                        <a href="{{ route('admin.releases.edit', $release) }}" 
                                                           class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                                                            ✏️ Editar
                                                        </a>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                    Não há releases documentadas para os filtros aplicados.
                                @else
                                    Não há releases documentadas no momento.
                                @endif
                            </p>
                            @if($ano || $mes || $semana)
                                <a href="{{ route('releases.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
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
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    👤 Minhas Releases
                                </a>
                                
                                @can('access-analista')
                                    <a href="{{ route('admin.releases.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                        ➕ Nova Release
                                    </a>
                                    
                                    <a href="{{ route('admin.releases.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700">
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
</x-app-layout>