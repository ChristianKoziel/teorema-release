<div class="bg-white shadow rounded-lg p-4 mb-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Menu de Releases</h3>
    
    @if(isset($menuLateral) && count($menuLateral))
        <div class="space-y-4">
            @foreach($menuLateral as $ano => $meses)
                <div class="border-l-2 border-blue-500 pl-3">
                    <button 
                        class="flex items-center justify-between w-full text-left font-medium text-blue-600 hover:text-blue-800"
                        onclick="toggleMenu('ano-{{ $ano }}')"
                    >
                        <span>🗓️ Ano {{ $ano }}</span>
                        <svg class="w-4 h-4 transition-transform" id="icon-ano-{{ $ano }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="menu-ano-{{ $ano }}" class="mt-2 ml-4 space-y-2 hidden">
                        @foreach($meses as $mesNumero => $semanas)
                            @php
                                $mesNome = \Carbon\Carbon::create()->month($mesNumero)->locale('pt_BR')->monthName;
                            @endphp
                            <div class="border-l-2 border-green-400 pl-3">
                                <button 
                                    class="flex items-center justify-between w-full text-left text-green-600 hover:text-green-800"
                                    onclick="toggleMenu('mes-{{ $ano }}-{{ $mesNumero }}')"
                                >
                                    <span>📅 {{ $mesNome }}</span>
                                    <svg class="w-4 h-4 transition-transform" id="icon-mes-{{ $ano }}-{{ $mesNumero }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div id="menu-mes-{{ $ano }}-{{ $mesNumero }}" class="mt-1 ml-4 space-y-1 hidden">
                                    @foreach($semanas as $semana)
                                        <a 
                                            href="{{ route('releases.index', ['ano' => $ano, 'mes' => $mesNumero, 'semana' => $semana]) }}"
                                            class="block text-gray-600 hover:text-gray-900 hover:bg-gray-50 p-1 rounded"
                                        >
                                            📌 Semana {{ $semana }}
                                        </a>
                                    @endforeach
                                    <!-- ADICIONE ESTE LINK PARA FILTRAR APENAS POR MÊS -->
                                    <div class="mt-2 ml-2">
                                        <a href="{{ route('releases.index', ['ano' => $ano, 'mes' => $mesNumero]) }}"
                                        class="block text-blue-600 hover:text-blue-800 text-sm hover:bg-blue-50 p-1 rounded">
                                            📅 Ver todas as releases de {{ $mesNome }}
                                        </a>
                                    </div>
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
        </script>
    @else
        <p class="text-gray-500 text-sm">Nenhuma release aprovada disponível.</p>
    @endif
    
    <div class="mt-6 pt-4 border-t">
        <h4 class="font-medium text-gray-700 mb-2">Filtros Rápidos</h4>
        <div class="space-y-2">
            <a href="{{ route('releases.index') }}" class="block text-blue-600 hover:text-blue-800">
                🔍 Todas as releases
            </a>
            @auth
                <a href="{{ route('releases.minha-area') }}" class="block text-blue-600 hover:text-blue-800">
                    👤 Minhas releases
                </a>
                @can('access-analista')
                    <a href="{{ route('admin.releases.index') }}" class="block text-blue-600 hover:text-blue-800">
                        ⚙️ Área administrativa
                    </a>
                @endcan
            @endauth
        </div>
    </div>
</div>