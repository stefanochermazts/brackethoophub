<nav class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 shadow-sm" role="navigation" aria-label="{{ __('Main navigation') }}" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group" aria-label="{{ __('Basketball Hub Home') }}">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105 relative">
                        <!-- Basketball -->
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="currentColor"/>
                            <!-- Basketball lines -->
                            <path d="M2 12h20M12 2a10 10 0 0 0 0 20M12 2a10 10 0 0 1 0 20" stroke="#ea5a0c" stroke-width="0.5" fill="none"/>
                            <path d="M6.34 6.34a10 10 0 0 0 11.32 11.32M17.66 6.34A10 10 0 0 0 6.34 17.66" stroke="#ea5a0c" stroke-width="0.5" fill="none"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Basketball Hub</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('features') }}" class="nav-link">
                    {{ __('Features') }}
                </a>
                <a href="{{ route('pricing') }}" class="nav-link">
                    {{ __('Pricing') }}
                </a>
                <a href="{{ route('about') }}" class="nav-link">
                    {{ __('About') }}
                </a>
                <a href="{{ route('contact') }}" class="nav-link">
                    {{ __('Contact') }}
                </a>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-3">
                <!-- Theme Toggle -->
                <button @click="theme = theme === 'light' ? 'dark' : 'light'" 
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :aria-label="theme === 'light' ? '{{ __('Switch to dark mode') }}' : '{{ __('Switch to light mode') }}'">
                    <!-- Sun Icon -->
                    <svg x-show="theme === 'light'" class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon Icon -->
                    <svg x-show="theme === 'dark'" class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- Language Selector -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 text-sm font-medium text-gray-700 dark:text-gray-300"
                            aria-haspopup="true" aria-expanded="false">
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700"
                         role="menu">
                        @foreach(['it', 'en', 'de', 'fr', 'sr', 'bs', 'sl', 'hr'] as $locale)
                            <a href="{{ route('language.switch', $locale) }}" 
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                               role="menuitem">
                                {{ __('languages.' . $locale) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="nav-link">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" 
                       class="btn btn-primary">
                        {{ __('Get Started') }}
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200"
                        aria-label="{{ __('Toggle mobile menu') }}">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-gray-900 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6 text-gray-900 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 shadow-lg">
            <a href="{{ route('features') }}" class="block px-3 py-2 nav-link rounded-md">
                {{ __('Features') }}
            </a>
            <a href="{{ route('pricing') }}" class="block px-3 py-2 nav-link rounded-md">
                {{ __('Pricing') }}
            </a>
            <a href="{{ route('about') }}" class="block px-3 py-2 nav-link rounded-md">
                {{ __('About') }}
            </a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 nav-link rounded-md">
                {{ __('Contact') }}
            </a>
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <a href="{{ route('login') }}" class="block px-3 py-2 nav-link rounded-md">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 btn btn-primary mt-2 text-center">
                    {{ __('Get Started') }}
                </a>
            </div>
        </div>
    </div>
</nav> 