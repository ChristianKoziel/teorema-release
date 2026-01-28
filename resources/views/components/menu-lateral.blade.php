<div class="bg-white shadow rounded-lg p-4 mb-6">
    <!-- Botão Home -->
    <div class="mb-6">
        <a href="{{ route('home') }}" 
           class="flex items-center space-x-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
            <span class="text-blue-600 text-xl">🏠</span>
            <span class="font-medium text-blue-800">Home</span>
        </a>
    </div>

    <!-- Título Release Week -->
    <div class="mb-4 pb-4 border-b">
        <h3 class="text-lg font-bold text-gray-800 flex items-center">
            <span class="mr-2">📅</span>
            Release Week
        </h3>
        <p class="text-sm text-gray-600 mt-1">Documentação de correções e melhorias</p>
    </div>

    <!-- Menu Release Week Mensal -->
    <div class="mb-4">
        <h4 class="font-medium text-gray-700 mb-3 flex items-center">
            <span class="mr-2">🗓️</span>
            Release Week Mensal
        </h4>
        
        @if(isset($menuLateral) && count($menuLateral))
            <div class="space-y-3">
                @foreach($menuLateral as $ano => $meses)
                    <div class="border-l-2 border-blue-500 pl-3">
                        <button 
                            class="flex items-center justify-between w-full text-left font-medium text-gray-700 hover:text-blue-600 mb-2"
                            onclick="toggleMenu('ano-{{ $ano }}')"
                        >
                            <div class="flex items-center">
                                <span class="mr-2">📆</span>
                                <span>Ano {{ $ano }}</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" id="icon-ano-{{ $ano }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="menu-ano-{{ $ano }}" class="ml-2 space-y-2 hidden">
                            @foreach($meses as $mesNumero => $semanas)
                                @php
                                    $mesNome = \Carbon\Carbon::create()->month($mesNumero)->locale('pt_BR')->monthName;
                                @endphp
                                <div class="border-l-2 border-green-400 pl-3">
                                    <button 
                                        class="flex items-center justify-between w-full text-left text-gray-600 hover:text-green-700 mb-1"
                                        onclick="toggleMenu('mes-{{ $ano }}-{{ $mesNumero }}')"
                                    >
                                        <div class="flex items-center">
                                            <span class="mr-2">📅</span>
                                            <span>{{ $mesNome }}</span>
                                        </div>
                                        <svg class="w-4 h-4 transition-transform" id="icon-mes-{{ $ano }}-{{ $mesNumero }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    
                                    <div id="menu-mes-{{ $ano }}-{{ $mesNumero }}" class="ml-2 space-y-1 hidden">
                                        @foreach($semanas as $semana)
                                            <a 
                                                href="{{ route('releases.index', ['ano' => $ano, 'mes' => $mesNumero, 'semana' => $semana]) }}"
                                                class="flex items-center text-gray-500 hover:text-gray-900 hover:bg-gray-50 p-2 rounded text-sm"
                                            >
                                                <span class="mr-2">📌</span>
                                                <span>Semana {{ $semana }}</span>
                                            </a>
                                        @endforeach
                                        
                                        <!-- Link para ver todas do mês -->
                                        <a href="{{ route('releases.index', ['ano' => $ano, 'mes' => $mesNumero]) }}"
                                           class="flex items-center text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-2 rounded text-sm mt-1">
                                            <span class="mr-2">👁️</span>
                                            <span>Ver todas do mês</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            
            <script>
                function toggleMenu(id) {
                    const menu = document.getElementById('menu-' + id);
                    const icon = document.getElementById('icon-' + id);
                    
                    if (menu.classList.contains('hidden')) {
                        menu.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        menu.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }
                }
                
                // Abrir menu se estiver filtrando
                @if(isset($ano) && $ano)
                    document.addEventListener('DOMContentLoaded', function() {
                        toggleMenu('ano-{{ $ano }}');
                        @if(isset($mes) && $mes)
                            toggleMenu('mes-{{ $ano }}-{{ $mes }}');
                        @endif
                    });
                @endif
            </script>
        @else
            <div class="text-center py-4">
                <div class="text-gray-400 text-3xl mb-2">📭</div>
                <p class="text-gray-500 text-sm">Nenhuma release documentada ainda.</p>
            </div>
        @endif
    </div>

    <!-- Links Rápidos -->
    <div class="pt-4 border-t">
        <h4 class="font-medium text-gray-700 mb-3">🔗 Acesso Rápido</h4>
        <div class="space-y-2">
            <a href="{{ route('releases.index') }}" 
               class="flex items-center text-gray-600 hover:text-gray-900 hover:bg-gray-50 p-2 rounded">
                <span class="mr-2">📋</span>
                Todas as Releases
            </a>
            
            @auth
                <a href="{{ route('releases.minha-area') }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 hover:bg-gray-50 p-2 rounded">
                    <span class="mr-2">👤</span>
                    Minhas Releases
                </a>
                
                @can('access-analista')
                    <a href="{{ route('admin.releases.create') }}" 
                       class="flex items-center text-green-600 hover:text-green-800 hover:bg-green-50 p-2 rounded">
                        <span class="mr-2">➕</span>
                        Nova Release
                    </a>
                    
                    <a href="{{ route('admin.releases.index') }}" 
                       class="flex items-center text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-2 rounded">
                        <span class="mr-2">⚙️</span>
                        Administração
                    </a>
                @endcan
            @endauth
        </div>
    </div>
    
    <!-- Estatísticas -->
    @if(isset($menuLateral) && count($menuLateral))
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-medium text-gray-700 mb-2">📊 Estatísticas</h4>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div class="bg-gray-50 p-2 rounded">
                    <div class="text-gray-600">Anos</div>
                    <div class="font-bold text-gray-800">{{ count($menuLateral) }}</div>
                </div>
                @php
                    $totalReleases = \App\Models\Release::aprovadas()->count();
                @endphp
                <div class="bg-blue-50 p-2 rounded">
                    <div class="text-blue-600">Releases</div>
                    <div class="font-bold text-blue-800">{{ $totalReleases }}</div>
                </div>
            </div>
        </div>
    @endif
</div>