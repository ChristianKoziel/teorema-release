<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teorema Sistemas - @yield('title', 'Releases')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --teorema-blue: #0053c5;
            --teorema-blue-light: #e8f1ff;
            --teorema-blue-dark: #003a8c;
            --teorema-green: #5afd01;
            --neutral-50: #fafafa;
            --neutral-100: #f5f5f5;
            --neutral-200: #e5e5e5;
            --neutral-300: #d4d4d4;
            --neutral-600: #525252;
            --neutral-700: #404040;
            --neutral-800: #262626;
            --sidebar-width: 280px;
            --topbar-height: 64px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--neutral-50);
            color: var(--neutral-800);
            line-height: 1.6;
        }

        /* ===== OVERLAY ===== */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1030;
            display: none;
            backdrop-filter: blur(2px);
        }

        .overlay.show {
            display: block;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            border-right: 1px solid var(--neutral-200);
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--neutral-300);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--neutral-600);
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        /* Logo Container */
        .logo-container {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--neutral-200);
            background: #ffffff;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            max-height: 45px;
            width: auto;
        }

        .logo-placeholder {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--teorema-blue), var(--teorema-blue-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--neutral-800);
            letter-spacing: -0.02em;
        }

        /* Navigation Groups */
        .nav-group {
            padding: 1.5rem 1rem 0.5rem;
        }

        .nav-group:first-of-type {
            padding-top: 1rem;
        }

        .nav-group-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--neutral-600);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.75rem;
            padding-left: 0.75rem;
        }

        /* Nav Links */
        .nav-link {
            color: var(--neutral-700);
            padding: 0.625rem 0.75rem;
            margin: 0.125rem 0;
            border-radius: 6px;
            text-decoration: none;
            position: relative;
            display: flex;
            align-items: center;
            transition: all 0.15s ease;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .nav-link:hover {
            background-color: var(--neutral-100);
            color: var(--teorema-blue);
        }

        .nav-link.active {
            background-color: var(--teorema-blue-light);
            color: var(--teorema-blue);
            font-weight: 600;
        }

        .nav-link i {
            width: 18px;
            margin-right: 0.75rem;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Submenu Styles */
        .submenu {
            padding-left: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submenu.show {
            max-height: 3000px;
        }

        .nav-link.has-submenu::after {
            content: '\f078';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 0.75rem;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
            color: var(--neutral-600);
        }

        .nav-link.has-submenu.collapsed::after {
            transform: rotate(-90deg);
        }

        /* Hierarchical Links */
        .year-link {
            padding-left: 1.5rem !important;
            font-size: 0.85rem;
        }

        .month-link {
            padding-left: 2.25rem !important;
            font-size: 0.8rem;
        }

        .week-link {
            padding-left: 3rem !important;
            font-size: 0.8rem;
        }

        /* Badges */
        .badge {
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.25em 0.5em;
            border-radius: 4px;
        }

        .float-end {
            margin-left: auto;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            background-color: var(--neutral-50);
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* ===== TOP NAVBAR ===== */
        .top-navbar {
            background: #ffffff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--neutral-200);
            position: sticky;
            top: 0;
            z-index: 1020;
            height: var(--topbar-height);
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--neutral-700);
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .menu-toggle:hover {
            background-color: var(--neutral-100);
            color: var(--teorema-blue);
        }

        .navbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--neutral-800);
            margin: 0;
            letter-spacing: -0.02em;
        }

        /* Search Box */
        .search-box-top {
            position: relative;
            width: 320px;
        }

        .search-box-top input {
            width: 100%;
            padding: 0.625rem 2.75rem 0.625rem 1rem;
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: var(--neutral-50);
        }

        .search-box-top input:focus {
            outline: none;
            border-color: var(--teorema-blue);
            background: #ffffff;
            box-shadow: 0 0 0 3px var(--teorema-blue-light);
        }

        .search-box-top i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neutral-600);
            pointer-events: none;
        }

        /* Login Button */
        .login-btn {
            background: var(--teorema-blue);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .login-btn:hover {
            background: var(--teorema-blue-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 83, 197, 0.25);
        }

        .btn-outline-secondary {
            border-color: var(--neutral-300);
            color: var(--neutral-700);
        }

        .btn-outline-secondary:hover {
            background: var(--neutral-100);
            border-color: var(--neutral-400);
            color: var(--neutral-800);
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--teorema-blue) 0%, #0045a5 100%);
            color: white;
            padding: 3.5rem 0;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            opacity: 0.3;
        }

        .hero-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
            position: relative;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            opacity: 0.95;
            line-height: 1.7;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        /* ===== INFO SECTION ===== */
        .info-section {
            padding: 3rem 0;
        }

        .section-title {
            color: var(--neutral-800);
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--teorema-blue);
            border-radius: 2px;
        }

        /* ===== OBJECTIVE CARDS ===== */
        .objective-card {
            background: #ffffff;
            border: 1px solid var(--neutral-200);
            border-radius: 12px;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            text-align: center;
        }

        .objective-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
            border-color: var(--teorema-blue-light);
        }

        .objective-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: var(--neutral-100);
            transition: all 0.3s ease;
        }

        .objective-card:hover .objective-icon {
            transform: scale(1.1);
        }

        .objective-icon i {
            font-size: 1.5rem;
        }

        .objective-card:nth-child(1) .objective-icon {
            background: var(--teorema-blue-light);
            color: var(--teorema-blue);
        }

        .objective-card:nth-child(2) .objective-icon {
            background: #e8ffe8;
            color: #2d8a2d;
        }

        .objective-card:nth-child(3) .objective-icon {
            background: #e0f7fa;
            color: #0097a7;
        }

        .objective-card:nth-child(4) .objective-icon {
            background: #fff8e1;
            color: #f57c00;
        }

        .objective-card h4 {
            color: var(--neutral-800);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.875rem;
            letter-spacing: -0.01em;
        }

        .objective-card p {
            color: var(--neutral-600);
            line-height: 1.7;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--neutral-800);
            color: #ffffff;
            padding: 2rem 0;
            margin-top: auto;
            border-top: 1px solid var(--neutral-700);
        }

        footer p {
            margin: 0;
        }

        footer .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .search-box-top {
                width: 180px;
            }

            .search-box-top input {
                padding: 0.5rem 2.5rem 0.5rem 0.875rem;
            }
            
            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 0.95rem;
            }

            .navbar-title {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .search-box-top {
                display: none;
            }

            .hero-section {
                padding: 2.5rem 0;
            }

            .info-section {
                padding: 2rem 0;
            }
        }

        /* ===== UTILITIES ===== */
        .text-current-date {
            color: var(--neutral-600);
            font-size: 0.875rem;
        }

        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Focus styles */
        button:focus-visible,
        a:focus-visible,
        input:focus-visible {
            outline: 2px solid var(--teorema-blue);
            outline-offset: 2px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-container">
            @if(file_exists(public_path('logo-black-2x.png')))
                <img src="{{ asset('logo-black-2x.png') }}" alt="Teorema Sistemas" class="logo">
            @else
                <div class="logo-placeholder">
                    <div class="logo-icon">T</div>
                    <span class="logo-text">TEOREMA</span>
                </div>
            @endif
        </div>
        
        <nav class="nav flex-column">
            <div class="nav-group">
                <div class="nav-group-title">Navegação</div>
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
            
            <div class="nav-group">
                <div class="nav-group-title">Documentação</div>
                
                <!-- Release Week Mensal com submenus -->
                <a class="nav-link has-submenu {{ request()->is('releases*') ? 'active' : '' }} {{ request()->routeIs('releases.index') ? '' : 'collapsed' }}" 
                   data-bs-toggle="collapse" href="#releaseWeekSubmenu">
                    <i class="fas fa-calendar-week"></i> Release Week Mensal
                </a>

                <div class="submenu collapse {{ request()->routeIs('releases.index') ? 'show' : '' }}" id="releaseWeekSubmenu">
                    <!-- Lista de anos -->
                    @php
                        use App\Models\Release;
                        $anos = Release::aprovadas()->distinct()->pluck('ano')->sort();
                    @endphp
                    
                    @if($anos->count() > 0)
                        @foreach($anos as $anoItem)
                            @php
                                $releasesAno = Release::aprovadas()->where('ano', $anoItem);
                                $countAno = $releasesAno->count();
                                $mesesAno = $releasesAno->distinct()->pluck('mes')->sort();
                            @endphp
                            
                            <a class="nav-link has-submenu year-link {{ request()->get('ano') == $anoItem ? 'active' : '' }} {{ request()->get('ano') == $anoItem && request()->get('mes') ? '' : 'collapsed' }}" 
                               data-bs-toggle="collapse" href="#meses{{ $anoItem }}">
                                <i class="far fa-calendar"></i>{{ $anoItem }}
                                <span class="badge bg-secondary float-end">{{ $countAno }}</span>
                            </a>
                            
                            <div class="submenu collapse {{ request()->get('ano') == $anoItem && request()->get('mes') ? 'show' : '' }}" id="meses{{ $anoItem }}">
                                <!-- Lista de meses -->
                                @if($mesesAno->count() > 0)
                                    @foreach($mesesAno as $mesNumero)
                                        @php
                                            $mesesNomes = [
                                                1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                                                5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                                                9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                                            ];
                                            $mesNome = $mesesNomes[$mesNumero] ?? 'Mês ' . $mesNumero;
                                            $releasesMes = Release::aprovadas()
                                                ->where('ano', $anoItem)
                                                ->where('mes', $mesNumero);
                                            $countMes = $releasesMes->count();
                                            $semanasMes = $releasesMes->distinct()->pluck('semana')->sort();
                                        @endphp
                                        
                                        <a class="nav-link has-submenu month-link {{ request()->get('ano') == $anoItem && request()->get('mes') == $mesNumero ? 'active' : '' }} {{ request()->get('ano') == $anoItem && request()->get('mes') == $mesNumero && request()->get('semana') ? '' : 'collapsed' }}" 
                                           data-bs-toggle="collapse" href="#semanas{{ $anoItem }}{{ $mesNumero }}">
                                            <i class="far fa-folder"></i>{{ $mesNome }}
                                            <span class="badge bg-secondary float-end">{{ $countMes }}</span>
                                        </a>
                                        
                                        <div class="submenu collapse {{ request()->get('ano') == $anoItem && request()->get('mes') == $mesNumero && request()->get('semana') ? 'show' : '' }}" id="semanas{{ $anoItem }}{{ $mesNumero }}">
                                            <!-- Lista de semanas -->
                                            @if($semanasMes->count() > 0)
                                                @foreach($semanasMes as $semanaNumero)
                                                    @php
                                                        $countSemana = Release::aprovadas()
                                                            ->where('ano', $anoItem)
                                                            ->where('mes', $mesNumero)
                                                            ->where('semana', $semanaNumero)
                                                            ->count();
                                                    @endphp
                                                    
                                                    <a class="nav-link week-link {{ request()->get('ano') == $anoItem && request()->get('mes') == $mesNumero && request()->get('semana') == $semanaNumero ? 'active' : '' }}" 
                                                       href="{{ route('releases.index', ['ano' => $anoItem, 'mes' => $mesNumero, 'semana' => $semanaNumero]) }}">
                                                        <i class="far fa-file-alt"></i>Semana {{ $semanaNumero }}
                                                        <span class="badge bg-secondary float-end">{{ $countSemana }}</span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Releases -->
                <a class="nav-link {{ request()->routeIs('releases.*') && !request()->is('/') && !request()->routeIs('home') ? 'active' : '' }}" href="{{ route('releases.index') }}">
                    <i class="fas fa-file-alt"></i> Todas as Releases
                </a>
            </div>

            @auth
            <div class="nav-group">
                <div class="nav-group-title">Administrativo</div>
                @can('access-analista')
                    <a class="nav-link {{ request()->routeIs('admin.releases.create') ? 'active' : '' }}" href="{{ route('admin.releases.create') }}">
                        <i class="fas fa-plus-circle"></i> Nova Release
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.releases.*') && !request()->routeIs('admin.releases.create') ? 'active' : '' }}" href="{{ route('admin.releases.index') }}">
                        <i class="fas fa-cog"></i> Gerenciar Releases
                    </a>
                @endcan
                @if(auth()->user()->isAdmin())
                    <a class="nav-link" href="{{ route('releases.minha-area') }}">
                        <i class="fas fa-user"></i> Minha Área
                    </a>
                @endif
            </div>
            @endauth
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="navbar-title">Releases</h4>
                </div>
                
                <!-- Barra de busca -->
                <div class="search-box-top">
                    <input type="text" 
                           id="globalSearchInput" 
                           placeholder="Buscar releases..."
                           aria-label="Buscar releases">
                    <i class="fas fa-search"></i>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <span class="text-current-date d-none d-md-flex align-items-center gap-2">
                        <i class="far fa-calendar"></i>
                        {{ now()->format('d/m/Y') }}
                    </span>
                    @auth
                        <span class="badge bg-primary">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i>Sair
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="login-btn">
                            <i class="fas fa-sign-in-alt"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-md-0 mb-2">
                            <i class="fas fa-rocket me-2"></i>
                            Teorema Sistemas - Documentação de Releases
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted">
                            <i class="far fa-copyright me-1"></i>
                            {{ date('Y') }} Teorema Sistemas - Coordenação de Suporte Segundo Nível
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const overlay = document.getElementById('overlay');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                }
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
        
        // Fechar sidebar ao clicar em link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768 && !this.classList.contains('has-submenu')) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });
        
        // Busca Global
        const globalSearchInput = document.getElementById('globalSearchInput');

        if (globalSearchInput) {
            globalSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = this.value.trim();
                    if (searchTerm.length >= 2) {
                        window.location.href = `/releases?search=${encodeURIComponent(searchTerm)}`;
                    }
                }
            });
        }

        // Manter submenus abertos baseados nos filtros
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const ano = urlParams.get('ano');
            const mes = urlParams.get('mes');
            
            if (ano) {
                const releaseWeekLink = document.querySelector('.nav-link.has-submenu[href="#releaseWeekSubmenu"]');
                if (releaseWeekLink) {
                    releaseWeekLink.classList.remove('collapsed');
                    const submenu = document.getElementById('releaseWeekSubmenu');
                    if (submenu) submenu.classList.add('show');
                }
                
                const yearLink = document.querySelector(`.year-link[href="#meses${ano}"]`);
                if (yearLink) {
                    yearLink.classList.remove('collapsed');
                    const yearSubmenu = document.getElementById(`meses${ano}`);
                    if (yearSubmenu) yearSubmenu.classList.add('show');
                }
                
                if (mes) {
                    const monthLink = document.querySelector(`.month-link[href="#semanas${ano}${mes}"]`);
                    if (monthLink) {
                        monthLink.classList.remove('collapsed');
                        const monthSubmenu = document.getElementById(`semanas${ano}${mes}`);
                        if (monthSubmenu) monthSubmenu.classList.add('show');
                    }
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>