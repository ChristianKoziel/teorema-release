<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Release: {{ $release->release_codigo }}
            </h2>
            <div class="flex items-center space-x-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold release-status-{{ $release->status }}">
                    {{ ucfirst(str_replace('_', ' ', $release->status)) }}
                </span>
                <a href="{{ route('admin.releases.show', $release) }}" 
                   class="text-sm text-gray-600 hover:text-gray-900">
                    ← Voltar para detalhes
                </a>
            </div>
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

                    <!-- Aviso para releases aprovadas -->
                    @if($release->status === 'aprovado' && !auth()->user()->isAdmin())
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center">
                                <span class="text-yellow-600 mr-2">⚠️</span>
                                <p class="text-yellow-700">
                                    Esta release já está aprovada. Apenas administradores podem editá-la.
                                </p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin.releases.update', $release) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.releases.partials.form')
                    </form>
                </div>
            </div>
            
            <!-- Ações extras para admin -->
            @if(auth()->user()->isAdmin())
                <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <h4 class="font-medium text-red-800 mb-2">⚠️ Área de Administrador</h4>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-red-700 mb-3 sm:mb-0">
                            Ações disponíveis apenas para administradores
                        </p>
                        <form action="{{ route('admin.releases.destroy', $release) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir permanentemente esta release? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                🗑️ Excluir Permanentemente
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>