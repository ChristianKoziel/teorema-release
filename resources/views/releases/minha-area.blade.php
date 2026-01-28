<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minhas Releases
            </h2>
            @can('access-analista')
                <a href="{{ route('admin.releases.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    ➕ Nova Release
                </a>
            @endcan
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
                            <!-- Estatísticas Pessoais -->
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm text-blue-600">Total</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ $releases->total() }}</p>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg">
                                    <p class="text-sm text-yellow-600">Rascunho</p>
                                    <p class="text-2xl font-bold text-yellow-800">
                                        {{ auth()->user()->releases()->where('status', 'rascunho')->count() }}
                                    </p>
                                </div>
                                <div class="bg-orange-50 p-4 rounded-lg">
                                    <p class="text-sm text-orange-600">Em Análise</p>
                                    <p class="text-2xl font-bold text-orange-800">
                                        {{ auth()->user()->releases()->where('status', 'em_analise')->count() }}
                                    </p>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <p class="text-sm text-green-600">Aprovadas</p>
                                    <p class="text-2xl font-bold text-green-800">
                                        {{ auth()->user()->releases()->where('status', 'aprovado')->count() }}
                                    </p>
                                </div>
                            </div>

                            @if($releases->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Release
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
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
                                                                    {{ $release->numero_chamado }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full release-status-{{ $release->status }}">
                                                            {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($release->data_liberacao)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            {{ $release->tipo_chamada == 'Correção' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                            {{ $release->tipo_chamada }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('releases.show', $release) }}" 
                                                           class="text-blue-600 hover:text-blue-900 mr-3">
                                                            👁️ Ver
                                                        </a>
                                                        @if($release->status !== 'aprovado' || auth()->user()->isAdmin())
                                                            <a href="{{ route('admin.releases.edit', $release) }}" 
                                                               class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                                ✏️ Editar
                                                            </a>
                                                        @endif
                                                        @if($release->status !== 'aprovado')
                                                            <form action="{{ route('admin.releases.destroy', $release) }}" 
                                                                  method="POST" 
                                                                  class="inline"
                                                                  onsubmit="return confirm('Tem certeza?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                                    🗑️ Excluir
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
                                    <div class="text-gray-400 text-6xl mb-4">📝</div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                                        Você ainda não criou nenhuma release
                                    </h3>
                                    <p class="text-gray-500 mb-6">
                                        Crie sua primeira release para começar a gerenciar suas alterações.
                                    </p>
                                    @can('access-analista')
                                        <a href="{{ route('admin.releases.create') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                            ➕ Criar Primeira Release
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>