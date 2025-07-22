<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - Basketball Hub')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts e Stili -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* === TEMA E LAYOUT UNIFICATO === */
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --sidebar-bg: #ffffff;
            --nav-text: #6b7280;
            --nav-hover: #f97316;
            --nav-active-bg: #f97316;
            --nav-active-text: #ffffff;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        body.dark {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border-color: #374151;
            --sidebar-bg: #1e293b;
            --nav-text: #94a3b8;
            --nav-hover: #f97316;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s, color 0.3s;
            font-family: 'Figtree', sans-serif;
        }

        .admin-container { display: flex; height: 100vh; }

        /* === SIDEBAR === */
        .sidebar {
            width: 16rem;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            background-color: var(--sidebar-bg) !important;
            border-right: 1px solid var(--border-color);
            transition: width 0.3s ease;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .sidebar-logo-container { display: flex; align-items: center; gap: 0.75rem; overflow: hidden; }
        .sidebar-logo {
            width: 2rem; height: 2rem; flex-shrink: 0;
            background-color: var(--nav-hover);
            border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center;
        }
        .sidebar-title { font-weight: 600; color: var(--text-primary); white-space: nowrap; }

        .toggle-sidebar { background: none; border: none; cursor: pointer; color: var(--text-secondary); }
        
        .sidebar-nav { flex: 1; padding: 0.5rem; overflow-y: auto; }
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem; margin-bottom: 0.25rem; border-radius: 0.5rem;
            color: var(--nav-text); text-decoration: none;
            transition: all 0.2s;
        }
        .nav-item:hover { background-color: rgba(249, 115, 22, 0.1); color: var(--nav-hover); transform: translateX(3px); }
        .nav-item.active { background-color: var(--nav-active-bg); color: var(--nav-active-text); box-shadow: 0 2px 4px rgba(249, 115, 22, 0.2); }
        .nav-icon { width: 1.25rem; height: 1.25rem; flex-shrink: 0; }
        .nav-text { white-space: nowrap; }

        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--border-color); }
        .user-info { display: flex; align-items: center; gap: 0.75rem; overflow: hidden; }
        .user-avatar {
            width: 2.25rem; height: 2.25rem; border-radius: 50%;
            background-color: var(--nav-hover);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .user-details { white-space: nowrap; }
        .user-name { font-weight: 500; color: var(--text-primary); font-size: 0.875rem; }
        .user-email { font-size: 0.75rem; color: var(--text-secondary); }
        .logout-btn { margin-left: auto; color: var(--text-secondary); }

        /* Sidebar Collapsed */
        .sidebar-collapsed { width: 4.5rem; }
        .sidebar-collapsed .sidebar-title, .sidebar-collapsed .user-details, .sidebar-collapsed .nav-text, .sidebar-collapsed .logout-btn { opacity: 0; width: 0; overflow: hidden; }
        .sidebar-collapsed .nav-item, .sidebar-collapsed .sidebar-header-content, .sidebar-collapsed .user-info { justify-content: center; }

        /* === CONTENUTO PRINCIPALE === */
        .main-content {
            width: calc(100% - 16rem);
            margin-left: 16rem;
            height: 100vh;
            overflow-y: auto;
            transition: width 0.3s ease, margin-left 0.3s ease;
        }
        .main-content-collapsed { width: calc(100% - 4.5rem); margin-left: 4.5rem; }
        
        .top-bar { background-color: var(--bg-primary); border-bottom: 1px solid var(--border-color); padding: 1rem 1.5rem; }
        .stat-card { background-color: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 0.75rem; box-shadow: var(--card-shadow); }

        /* Controlli Top Bar */
        .theme-button {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            border-radius: 0.5rem;
            padding: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            border: none; cursor: pointer;
        }
        .lang-dropdown-btn { gap: 0.5rem; padding: 0.5rem 0.75rem; }
        .lang-dropdown-content {
             display: none; position: absolute; right: 0; margin-top: 0.5rem;
             background-color: var(--bg-primary); border: 1px solid var(--border-color);
             border-radius: 0.5rem; box-shadow: var(--card-shadow); z-index: 50; min-width: 10rem;
        }
        .lang-dropdown.show .lang-dropdown-content { display: block; }
        .lang-dropdown-item { display: block; padding: 0.5rem 1rem; color: var(--text-primary); text-decoration: none; }
        .lang-dropdown-item:hover { background-color: var(--bg-secondary); }
    </style>
</head>
<body class="antialiased">
    <div class="admin-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar sidebar-expanded">
            <!-- Header -->
            <div class="sidebar-header">
                <div class="sidebar-logo-container">
                    <div class="sidebar-logo">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                           <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 8a4 4 0 118 0 4 4 0 01-8 0z"/>
                        </svg>
                    </div>
                                             <span class="sidebar-title">{{ __('admin.admin_panel') }}</span>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/></svg>
                                         <span class="nav-text">{{ __('admin.dashboard') }}</span>
                </a>
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                                         <span class="nav-text">{{ __('admin.users') }}</span>
                </a>
                                 <a href="{{ route('admin.tournaments.index') }}" class="nav-item {{ request()->routeIs('admin.tournaments.*') ? 'active' : '' }}">
                   <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                         <span class="nav-text">{{ __('admin.tournaments') }}</span>
                </a>
                                 @if(auth()->user()->isAdmin())
                 <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                     <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                     <span class="nav-text">{{ __('admin.settings') }}</span>
                 </a>
                 @endif
            </nav>

            <!-- User Info -->
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-email">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="main-content" class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold">@yield('title', __('admin.admin_panel'))</h1>
                    <div class="flex items-center space-x-2">
                        <!-- Language Selector -->
                        <div class="lang-dropdown relative">
                            <button onclick="toggleLanguageDropdown()" class="theme-button lang-dropdown-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                                <span>{{ strtoupper(app()->getLocale()) }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="languageDropdown" class="lang-dropdown-content">
                                @foreach(['it', 'en', 'de', 'fr', 'sr', 'bs', 'sl', 'hr'] as $locale)
                                    <a href="{{ route('language.switch', $locale) }}" class="lang-dropdown-item">{{ __('languages.' . $locale) }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="theme-button">
                            <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('toggle-sidebar');
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Funzione per applicare il tema
            const applyTheme = (theme) => {
                if (theme === 'dark') {
                    document.body.classList.add('dark');
                    darkIcon.style.display = 'block';
                    lightIcon.style.display = 'none';
                } else {
                    document.body.classList.remove('dark');
                    darkIcon.style.display = 'none';
                    lightIcon.style.display = 'block';
                }
            };

            // Toggle Tema
            themeToggleBtn.addEventListener('click', () => {
                const isDark = document.body.classList.contains('dark');
                const newTheme = isDark ? 'light' : 'dark';
                localStorage.setItem('color-theme', newTheme);
                applyTheme(newTheme);
            });
            
            // Applica tema al caricamento
            const storedTheme = localStorage.getItem('color-theme') || 'light';
            applyTheme(storedTheme);

            // Toggle Sidebar
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('main-content-collapsed');
            });

            // Dropdown Lingua
            const langDropdownBtn = document.querySelector('.lang-dropdown-btn');
            if(langDropdownBtn) {
                langDropdownBtn.addEventListener('click', (event) => {
                    event.stopPropagation();
                    document.querySelector('.lang-dropdown').classList.toggle('show');
                });
            }
            document.addEventListener('click', () => {
                document.querySelector('.lang-dropdown')?.classList.remove('show');
            });
        });
    </script>
</body>
</html> 