@extends('layouts.app')

@section('title', __('Basketball Hub - Piattaforma SaaS per Gestione Tornei'))

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 hero-gradient"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500/10 rounded-full animate-float"></div>
    <div class="absolute top-40 right-20 w-16 h-16 bg-orange-500/10 rounded-full animate-float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 left-20 w-12 h-12 bg-green-500/10 rounded-full animate-float" style="animation-delay: -4s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                    {{ __('Piattaforma SaaS Leader') }}
                </div>
                
                <h1 class="text-4xl lg:text-6xl xl:text-7xl font-bold text-white mb-6 leading-tight">
                    {{ __('Gestione Tornei di') }}
                    <span class="text-gradient" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ __('Pallacanestro') }}</span>
                    <span class="block">{{ __('Semplificata') }}</span>
                </h1>
                
                <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                    {{ __('La piattaforma SaaS completa per organizzatori, società e allenatori. Bracket automation, scoring mobile, dashboard statistiche avanzate e molto altro.') }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                    <a href="{{ route('register') }}" 
                       class="btn bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 group">
                        <span>{{ __('Inizia Gratis') }}</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('features') }}" 
                       class="btn btn-outline text-white border-white hover:bg-white hover:text-blue-600 text-lg px-8 py-4">
                        {{ __('Scopri le Funzionalità') }}
                    </a>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-6 text-sm text-blue-200">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ __('14 giorni di prova gratuita') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ __('Nessuna carta di credito') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <!-- Main Dashboard Card -->
                <div class="card shadow-soft transform rotate-3 hover:rotate-0 transition-all duration-500 hover:scale-105">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ __('Torneo Estivo 2024') }}</h3>
                        </div>
                        <span class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-xs font-medium">{{ __('Live') }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">24</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Squadre') }}</div>
                        </div>
                        <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">8</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Gironi') }}</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-300 mb-2 font-medium">{{ __('Prossima partita') }}</div>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-gray-900 dark:text-white">Team A vs Team B</span>
                            <span class="text-blue-600 dark:text-blue-400 font-bold">15:30</span>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Stats Card -->
                <div class="absolute -top-4 -right-4 card shadow-soft w-32">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900 dark:text-white">156</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">{{ __('Partite') }}</div>
                    </div>
                </div>
                
                <!-- Floating User Card -->
                <div class="absolute -bottom-4 -left-4 card shadow-soft w-40">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">JD</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">John Doe</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ __('Organizzatore') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                {{ __('Funzionalità Avanzate') }}
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('Tutto quello che serve per') }}
                <span class="text-gradient-enhanced">{{ __('organizzare tornei perfetti') }}</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                {{ __('Dalla creazione del torneo alla gestione delle statistiche, Basketball Hub ti accompagna in ogni fase dell\'organizzazione.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Bracket Automation') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Genera automaticamente tabelloni eliminatori, a gironi o misti. Modifica facilmente con drag & drop.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Round-robin e knockout') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Drag & drop editor') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Feature 2 -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Mobile Scoring') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Inserisci i punteggi in tempo reale da qualsiasi dispositivo. Interfaccia ottimizzata per tablet e smartphone.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Scoring in tempo reale') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Responsive design') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Feature 3 -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Dashboard Statistiche') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Analizza performance individuali e di squadra con grafici interattivi e report dettagliati.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Statistiche avanzate') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Export PDF/CSV') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-br from-blue-600 to-orange-600 relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-white mb-6">
            {{ __('Pronto a rivoluzionare i tuoi tornei?') }}
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            {{ __('Unisciti a centinaia di organizzatori che hanno già scelto Basketball Hub per gestire i loro eventi.') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="btn bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                {{ __('Inizia la Prova Gratuita') }}
            </a>
            <a href="{{ route('contact') }}" 
               class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 text-lg px-8 py-4 font-semibold transition-all duration-300">
                {{ __('Contattaci') }}
            </a>
        </div>
    </div>
</section>
@endsection 