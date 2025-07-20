@extends('layouts.admin')

@section('title', 'Impostazioni')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Impostazioni</h2>
            <p class="text-gray-600 dark:text-gray-400">Configura le impostazioni della piattaforma</p>
        </div>
    </div>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- General Settings -->
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Impostazioni Generali</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nome Piattaforma
                    </label>
                    <input type="text" value="Basketball Hub" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email di Contatto
                    </label>
                    <input type="email" value="info@brackethoophub.com" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Lingua Predefinita
                    </label>
                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                        <option value="it">Italiano</option>
                        <option value="en">English</option>
                        <option value="de">Deutsch</option>
                        <option value="fr">Français</option>
                        <option value="sl">Slovenščina</option>
                        <option value="hr">Hrvatski</option>
                        <option value="bs">Bosanski</option>
                        <option value="sr">Српски</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sicurezza</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Autenticazione a due fattori</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Richiedi 2FA per gli amministratori</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 dark:bg-gray-700">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Sessione automatica</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Mantieni l'utente connesso</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Log di sicurezza</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Registra tutti gli accessi</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Configurazione Email</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        SMTP Host
                    </label>
                    <input type="text" placeholder="smtp.gmail.com" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        SMTP Port
                    </label>
                    <input type="number" placeholder="587" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email From
                    </label>
                    <input type="email" placeholder="noreply@brackethoophub.com" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                </div>
            </div>
        </div>

        <!-- Backup Settings -->
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Backup e Manutenzione</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Backup automatico</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Backup giornaliero del database</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Pulizia log</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Elimina log vecchi di 30 giorni</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
                <div class="pt-4">
                    <button class="w-full btn-primary py-2 rounded-lg">
                        Esegui Backup Manuale
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button class="btn-primary px-6 py-2 rounded-lg">
            Salva Impostazioni
        </button>
    </div>
</div>
@endsection 