<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - Basketball Hub')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        :root {
            --primary-color: #f97316;
            --primary-dark: #ea580c;
            --primary-light: #fed7aa;
            --secondary-color: #1e293b;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --background-light: #ffffff;
            --background-dark: #0f172a;
            --text-light: #1e293b;
            --text-dark: #f8fafc;
            --border-light: #e2e8f0;
            --border-dark: #334155;
        }

        .dark {
            --primary-color: #f97316;
            --primary-dark: #ea580c;
            --primary-light: #fed7aa;
            --secondary-color: #1e293b;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --background-light: #0f172a;
            --background-dark: #020617;
            --text-light: #f8fafc;
            --text-dark: #1e293b;
            --border-light: #334155;
            --border-dark: #475569;
        }

        body {
            background: linear-gradient(135deg, var(--background-light) 0%, #f8fafc 100%);
            color: var(--text-light);
            height: 100vh;
            overflow-x: hidden;
        }

        .dark body {
            background: linear-gradient(135deg, var(--background-dark) 0%, #0f172a 100%);
            color: var(--text-light);
        }

        .admin-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--secondary-color) 0%, #1e293b 100%);
            border-right: 1px solid var(--border-light);
            transition: all 0.3s ease;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
        }

        .dark .sidebar {
            border-right: 1px solid var(--border-dark);
        }

        .sidebar-collapsed {
            width: 4rem;
        }

        .sidebar-expanded {
            width: 16rem;
        }

        .main-content {
            transition: margin-left 0.3s ease;
            flex: 1;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content-expanded {
            margin-left: 16rem;
        }

        .main-content-collapsed {
            margin-left: 4rem;
        }

        .nav-item {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            padding: 0.75rem;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary-color);
        }

        .nav-item.active {
            background: var(--primary-color);
            color: white;
            margin: 0.25rem 0.25rem;
            border-radius: 0.75rem;
        }

        .nav-icon {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-text {
            transition: opacity 0.3s ease;
            margin-left: 0.75rem;
            text-align: center;
        }

        .sidebar-collapsed .nav-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-expanded .nav-text {
            opacity: 1;
            width: auto;
        }

        .card {
            background: var(--background-light);
            border: 1px solid var(--border-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .dark .card {
            background: var(--background-dark);
            border: 1px solid var(--border-dark);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--background-light) 0%, #f8fafc 100%);
            border: 1px solid var(--border-light);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .dark .stat-card {
            background: linear-gradient(135deg, var(--background-dark) 0%, #1e293b 100%);
            border: 1px solid var(--border-dark);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .toggle-sidebar {
            background: var(--primary-color);
            border: none;
            color: white;
            border-radius: 0.5rem;
            padding: 0.5rem;
            transition: all 0.2s ease;
            flex-shrink: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-sidebar:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .sidebar-header-content {
            display: flex;
            align-items: center;
            space-x: 3;
        }

        .sidebar-logo {
            width: 2rem;
            height: 2rem;
            background: var(--primary-color);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-title {
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
            margin-left: 0.75rem;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .user-info {
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .user-info {
            opacity: 0;
            height: 0;
            overflow: hidden;
        }

        .sidebar-expanded .user-info {
            opacity: 1;
            height: auto;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar-expanded {
                width: 4rem;
            }
            
            .main-content-expanded {
                margin-left: 4rem;
            }
            
            .sidebar-header-content {
                display: none;
            }
            
            .sidebar-header {
                justify-content: center;
            }
        }
    </style>
</head>
<body class="h-full font-sans antialiased">
    <div class="admin-container">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar sidebar-expanded">
            <!-- Header -->
            <div class="sidebar-header">
                <div class="sidebar-header-content">
                    <div class="sidebar-logo">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 8a4 4 0 118 0 4 4 0 01-8 0z"/>
                        </svg>
                    </div>
                    <span class="sidebar-title">Admin Panel</span>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-item text-gray-300 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    </svg>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.users') }}" class="nav-item text-gray-300 hover:text-white {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <span class="nav-text">Utenti</span>
                </a>

                <a href="{{ route('admin.tournaments') }}" class="nav-item text-gray-300 hover:text-white {{ request()->routeIs('admin.tournaments') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="nav-text">Tornei</span>
                </a>

                <a href="{{ route('admin.settings') }}" class="nav-item text-gray-300 hover:text-white {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="nav-text">Impostazioni</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-white text-sm font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-gray-400 text-xs">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="main-content main-content-expanded">
            <!-- Top Bar -->
            <div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@yield('title', 'Admin Panel')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                            <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-sidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');
            mainContent.classList.toggle('main-content-collapsed');
            mainContent.classList.toggle('main-content-expanded');
        });

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Check for saved theme preference or default to light
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            document.documentElement.classList.add('dark');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggle.addEventListener('click', function() {
            // Toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Toggle theme
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>
</body>
</html> 