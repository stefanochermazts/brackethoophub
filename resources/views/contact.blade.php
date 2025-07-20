@extends('layouts.app')

@section('title', __('Contatti - Basketball Hub'))

@section('content')
<section class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                {{ __('Parliamone') }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('Contattaci') }}
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                {{ __('Hai domande, suggerimenti o vuoi saperne di più su Basketball Hub? Siamo qui per aiutarti.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="card">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Inviaci un messaggio') }}</h2>
                <form class="space-y-6">
                    <div>
                        <label for="name" class="form-label">{{ __('Nome completo') }}</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="{{ __('Il tuo nome') }}" required>
                    </div>
                    
                    <div>
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="{{ __('la-tua@email.com') }}" required>
                    </div>
                    
                    <div>
                        <label for="subject" class="form-label">{{ __('Oggetto') }}</label>
                        <select id="subject" name="subject" class="form-input">
                            <option value="">{{ __('Seleziona un oggetto') }}</option>
                            <option value="support">{{ __('Supporto tecnico') }}</option>
                            <option value="sales">{{ __('Informazioni commerciali') }}</option>
                            <option value="feature">{{ __('Richiesta funzionalità') }}</option>
                            <option value="partnership">{{ __('Partnership') }}</option>
                            <option value="other">{{ __('Altro') }}</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="form-label">{{ __('Messaggio') }}</label>
                        <textarea id="message" name="message" rows="6" class="form-input resize-none" placeholder="{{ __('Descrivi la tua richiesta...') }}" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full">
                        <span>{{ __('Invia Messaggio') }}</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Office Info -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('I nostri uffici') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('Sede Principale') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">Via del Basket, 123<br>20123 Milano, Italia</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('Telefono') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">+39 02 1234 5678</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('Email') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">info@basketballhub.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Hours -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Orari di supporto') }}</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Lunedì - Venerdì') }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">9:00 - 18:00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Sabato') }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">10:00 - 16:00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Domenica') }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ __('Chiuso') }}</span>
                        </div>
                    </div>
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            <strong>{{ __('Nota:') }}</strong> {{ __('Per urgenze tecniche, il nostro supporto è disponibile 24/7 via email.') }}
                        </p>
                    </div>
                </div>

                <!-- FAQ Link -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Hai bisogno di aiuto immediato?') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ __('Consulta le nostre FAQ per trovare risposte immediate alle domande più comuni.') }}
                    </p>
                    <a href="#" class="btn btn-outline">
                        {{ __('Vai alle FAQ') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Contact Options -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">{{ __('Altri modi per contattarci') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Live Chat -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('Live Chat') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('Chatta con il nostro team in tempo reale.') }}</p>
                    <button class="btn btn-outline btn-sm">{{ __('Avvia Chat') }}</button>
                </div>

                <!-- Community -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('Community') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('Unisciti alla community di organizzatori.') }}</p>
                    <a href="#" class="btn btn-outline btn-sm">{{ __('Vai al Forum') }}</a>
                </div>

                <!-- Video Call -->
                <div class="card text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('Demo Gratuita') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('Prenota una demo personalizzata.') }}</p>
                    <a href="#" class="btn btn-outline btn-sm">{{ __('Prenota Demo') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 