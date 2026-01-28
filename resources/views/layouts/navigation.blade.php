<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Lado Esquerdo: Logo e Nome -->
            <div class="flex items-center">
                <!-- Logo Teorema -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('releases.index') }}" class="flex items-center space-x-3">
                        <!-- Substitua por sua logo ou use texto -->
                        <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">T</span>
                        </div>
                        <span class="text-xl font-bold text-gray-800">TEOREMA</span>
                    </a>
                </div>

                <!-- Menu Central: Apenas Home -->
                <div class="hidden sm:flex sm:items-center sm:ms-10">
                    <x-nav-link :href="route('releases.index')" :active="request()->routeIs('releases.index')">
                        🏠 Home
                    </x-nav-link>
                </div>
            </div>

            <!-- Centro: Barra de Pesquisa -->
            <div class="flex-1 max-w-2xl mx-4">
                <form action="{{ route('releases.index') }}" method="GET" class="w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Pesquisar releases..."
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </form>
            </div>

            <!-- Lado Direito: Botões de Ação -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Botão Administração -->
                    @can('access-analista')
                        <a href="{{ route('admin.releases.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-4">
                            ⚙️ Administração
                        </a>
                    @endcan

                    <!-- Dropdown do usuário -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex items-center">
                                        <!-- Avatar do usuário -->
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                                            <span class="text-blue-600 font-medium text-sm">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <span>{{ Auth::user()->name }}</span>
                                    </div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Badge de Role -->
                                <div class="px-4 py-2 border-b">
                                    @if(auth()->user()->isAdmin())
                                        <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded">
                                            👑 Administrador
                                        </span>
                                    @elseif(auth()->user()->isAnalista())
                                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">
                                            🔧 Analista
                                        </span>
                                    @endif
                                </div>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <span class="text-red-600">🚪 Sair</span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Botões para visitantes -->
                    <div class="flex space-x-3">
                        <x-nav-link :href="route('login')" class="text-gray-600 hover:text-gray-900">
                            🔑 Entrar
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Hamburger Menu Mobile -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('releases.index')" :active="request()->routeIs('releases.index')">
                🏠 Home
            </x-responsive-nav-link>
            
            @auth
                <x-responsive-nav-link :href="route('releases.minha-area')" :active="request()->routeIs('releases.minha-area')">
                    👤 Minha Área
                </x-responsive-nav-link>
                
                @can('access-analista')
                    <x-responsive-nav-link :href="route('admin.releases.index')" :active="request()->routeIs('admin.*')">
                        ⚙️ Administração
                    </x-responsive-nav-link>
                @endcan
                
                <!-- Authentication -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                🚪 Sair
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')">
                    🔑 Entrar
                </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>