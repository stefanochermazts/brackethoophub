@extends('layouts.app')

@section('title', __('Chi Siamo - Basketball Hub'))

@section('content')
<section class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                {{ __('La Nostra Storia') }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('Chi Siamo') }}
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                {{ __('Basketball Hub nasce dalla passione per la pallacanestro e dalla necessità di semplificare la gestione dei tornei.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('La Nostra Missione') }}</h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Vogliamo democratizzare l\'accesso a strumenti professionali per la gestione di tornei di pallacanestro, rendendo possibile per organizzatori di ogni dimensione creare eventi di qualità.') }}
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    {{ __('La nostra piattaforma combina la semplicità d\'uso con funzionalità avanzate, permettendo di concentrarsi su quello che conta davvero: il gioco.') }}
                </p>
            </div>
            <div class="card text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Innovazione Continua') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ __('Sviluppiamo costantemente nuove funzionalità basate sui feedback della community.') }}</p>
            </div>
        </div>

        <!-- Values Section -->
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('I Nostri Valori') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Passione') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Amore per la pallacanestro e per la tecnologia.') }}</p>
                </div>
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Affidabilità') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Piattaforma stabile e sicura per i tuoi eventi.') }}</p>
                </div>
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Community') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Costruiamo insieme il futuro del basket.') }}</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Il Nostro Team') }}</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-12 max-w-2xl mx-auto">
                {{ __('Un team di sviluppatori, designer e appassionati di basket che lavorano per rendere ogni torneo un successo.') }}
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">MR</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Marco Rossi</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-sm mb-2">{{ __('CEO & Founder') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('Ex giocatore professionista e sviluppatore senior.') }}</p>
                </div>

                <!-- Team Member 2 -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">LB</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Laura Bianchi</h3>
                    <p class="text-orange-600 dark:text-orange-400 text-sm mb-2">{{ __('CTO') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('Esperta in architetture scalabili e cloud computing.') }}</p>
                </div>

                <!-- Team Member 3 -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">GV</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Giulia Verdi</h3>
                    <p class="text-green-600 dark:text-green-400 text-sm mb-2">{{ __('Lead Designer') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('Specializzata in UX/UI design e interfacce intuitive.') }}</p>
                </div>

                <!-- Team Member 4 -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">AN</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Alessandro Neri</h3>
                    <p class="text-orange-600 dark:text-orange-400 text-sm mb-2">{{ __('Product Manager') }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('Coordinatore prodotto e liaison con la community.') }}</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center bg-gradient-to-br from-blue-600 to-orange-600 rounded-2xl p-12 text-white">
            <h2 class="text-3xl font-bold mb-6">
                {{ __('Vuoi far parte della famiglia Basketball Hub?') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                {{ __('Unisciti a migliaia di organizzatori che già utilizzano la nostra piattaforma per gestire i loro tornei.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                   class="btn bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 font-semibold">
                    {{ __('Inizia Subito') }}
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