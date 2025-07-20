@extends('layouts.app')

@section('title', __('Funzionalità - Basketball Hub'))

@section('content')
<section class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                {{ __('Funzionalità Complete') }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('Funzionalità Complete per') }}
                <span class="text-gradient">{{ __('Tornei Professionali') }}</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                {{ __('Scopri tutte le funzionalità che rendono Basketball Hub la piattaforma più completa per la gestione di tornei di pallacanestro.') }}
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Bracket Management -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Gestione Bracket') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Creazione automatica di tabelloni eliminatori, a gironi o misti. Editor drag & drop intuitivo per modifiche al volo.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Round-robin e knockout') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Editor drag & drop') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Seeding automatico') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Mobile Scoring -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Mobile Scoring') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Inserimento punteggi in tempo reale da qualsiasi dispositivo. Interfaccia ottimizzata per tablet e smartphone.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Scoring live') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Multi-device sync') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Backup automatico') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Dashboard & Analytics -->
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Dashboard Statistiche') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Analisi dettagliate delle performance con grafici interattivi e report personalizzabili.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Statistiche avanzate') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Export PDF/CSV') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Report personalizzati') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center bg-gradient-to-br from-blue-600 to-orange-600 rounded-2xl p-12 text-white">
            <h2 class="text-3xl font-bold mb-6">
                {{ __('Pronto a iniziare?') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                {{ __('Inizia subito a gestire i tuoi tornei con tutte le funzionalità professionali di Basketball Hub.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                   class="btn bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 font-semibold">
                    {{ __('Inizia la Prova Gratuita') }}
                </a>
                <a href="{{ route('contact') }}" 
                   class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 text-lg px-8 py-4 font-semibold">
                    {{ __('Contattaci') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection 