@extends('layouts.app')

@section('title', __('Prezzi - Basketball Hub'))

@section('content')
<section class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium mb-6">
                {{ __('Piani Tariffari') }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('Piani e Prezzi') }}
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                {{ __('Scegli il piano perfetto per le tue esigenze. Tutti i piani includono una prova gratuita di 14 giorni.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Starter Plan -->
            <div class="card">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Starter') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Perfetto per piccoli tornei') }}</p>
                    <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">€29<span class="text-lg text-gray-500 dark:text-gray-400">/mese</span></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('o €290/anno') }}</p>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Fino a 8 squadre') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Bracket automation') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Mobile scoring') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Report base') }}</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-secondary w-full">
                    {{ __('Inizia Gratis') }}
                </a>
            </div>

            <!-- Pro Plan -->
            <div class="card border-2 border-blue-500 relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold">{{ __('Più Popolare') }}</span>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Pro') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Per tornei professionali') }}</p>
                    <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">€79<span class="text-lg text-gray-500 dark:text-gray-400">/mese</span></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('o €790/anno') }}</p>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Fino a 32 squadre') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Tutte le funzionalità Starter') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Dashboard avanzate') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('API access') }}</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-primary w-full">
                    {{ __('Inizia Gratis') }}
                </a>
            </div>

            <!-- Enterprise Plan -->
            <div class="card">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Enterprise') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Per grandi organizzazioni') }}</p>
                    <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Personalizzato') }}</div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Contattaci') }}</p>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Squadre illimitate') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Tutte le funzionalità Pro') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('API personalizzate') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ __('Account manager dedicato') }}</span>
                    </li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-secondary w-full">
                    {{ __('Contattaci') }}
                </a>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Domande Frequenti') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('Tutto quello che devi sapere sui nostri piani.') }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Posso cambiare piano in qualsiasi momento?') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Sì, puoi aggiornare o modificare il tuo piano in qualsiasi momento dalla dashboard del tuo account.') }}</p>
                </div>
                
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Cosa include la prova gratuita?') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('La prova gratuita di 14 giorni include tutte le funzionalità del piano Pro senza limitazioni.') }}</p>
                </div>
                
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Offrite sconti per organizzazioni no-profit?') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Sì, offriamo sconti speciali per organizzazioni no-profit e istituzioni educative. Contattaci per maggiori dettagli.') }}</p>
                </div>
                
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('È possibile pagare annualmente?') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Sì, con il pagamento annuale risparmi il 20% rispetto al pagamento mensile.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 