<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Administração de Releases
            </h2>
            <a href="{{ route('admin.releases.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                ➕ Nova Release
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <form action="{{ route('admin.releases.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                        <input type="text" 
                               name="search" 
                               id="search"
                               value="{{ request('search') }}"
                               placeholder="Número, código ou agente..."
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" 
                                id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Todos</option>
                            <option value="rascunho" {{ request('status') == 'rascunho' ? 'selected' : '' }}>Rascunho</option>
                            <option value="em_analise" {{ request('status') == 'em_analise' ? 'selected' : '' }}>Em Análise</option>
                            <option value="aprovado" {{ request('status') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            🔍 Filtrar
                        </button>
                        <a href="{{ route('admin.releases.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 ml-2">
                            🗑️ Limpar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                @php
                    $total = \App\Models\Release::count();
                    $rascunho = \App\Models\Release::where('status', 'rascunho')->count();
                    $analise = \App\Models\Release::where('status', 'em_analise')->count();
                    $aprovado = \App\Models\Release::where('status', 'aprovado')->count();
                @endphp
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <p class="text-sm text-yellow-600">Rascunho</p>
                    <p class="text-2xl font-bold text-yellow-800">{{ $rascunho }}</p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg">
                    <p class="text-sm text-orange-600">Em Análise</p>
                    <p class="text-2xl font-bold text-orange-800">{{ $analise }}</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm text-green-600">Aprovadas</p>
                    <p class="text-2xl font-bold text-green-800">{{ $aprovado }}</p>
                </div>
            </div>

            <!-- Tabela -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($releases->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Release
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Criador
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Data
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($releases as $release)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $release->release_codigo }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $release->numero_chamado }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $release->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $release->agente }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full release-status-{{ $release->status }}">
                                                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.releases.show', $release) }}" 
                                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                                    👁️
                                                </a>
                                                <a href="{{ route('admin.releases.edit', $release) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                    ✏️
                                                </a>
                                                @if(auth()->user()->isAdmin())
                                                    <form action="{{ route('admin.releases.destroy', $release) }}" 
                                                          method="POST" 
                                                          class="inline"
                                                          onsubmit="return confirm('Tem certeza?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            🗑️
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

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
                                @if(request()->hasAny(['search', 'status']))
                                    Tente ajustar os filtros ou
                                @endif
                                Crie sua primeira release.
                            </p>
                            <a href="{{ route('admin.releases.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                ➕ Criar Primeira Release
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>