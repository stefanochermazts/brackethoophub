@extends('layouts.admin')

@section('title', 'Impostazioni')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-primary">Impostazioni</h2>
            <p class="text-secondary">Configura le impostazioni della piattaforma</p>
        </div>
    </div>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- General Settings -->
        <div class="stat-card p-6">
            <h3 class="text-lg font-semibold text-primary mb-4">Impostazioni Generali</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        Nome Piattaforma
                    </label>
                    <input type="text" value="Basketball Hub" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        Email di Contatto
                    </label>
                    <input type="email" value="info@brackethoophub.com" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        Lingua Predefinita
                    </label>
                    <select class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="it">Italiano</option>
                        <option value="en">English</option>
                        <option value="de">Deutsch</option>
                        <option value="fr">Français</option>
                        <option value="sr">Srpski</option>
                        <option value="bs">Bosanski</option>
                        <option value="sl">Slovenščina</option>
                        <option value="hr">Hrvatski</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="stat-card p-6">
            <h3 class="text-lg font-semibold text-primary mb-4">Sicurezza</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary">Autenticazione a due fattori</p>
                        <p class="text-sm text-secondary">Richiedi 2FA per gli amministratori</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary">Sessione automatica</p>
                        <p class="text-sm text-secondary">Mantieni l'utente connesso</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary">Log di sicurezza</p>
                        <p class="text-sm text-secondary">Registra tutti gli accessi</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Email Configuration -->
        <div class="stat-card p-6">
            <h3 class="text-lg font-semibold text-primary mb-4">Configurazione Email</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        SMTP Host
                    </label>
                    <input type="text" value="smtp.gmail.com" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        SMTP Port
                    </label>
                    <input type="number" value="587" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        Username
                    </label>
                    <input type="email" placeholder="your-email@gmail.com" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">
                        Password
                    </label>
                    <input type="password" placeholder="••••••••••••" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Backup Settings -->
        <div class="stat-card p-6">
            <h3 class="text-lg font-semibold text-primary mb-4">Backup e Manutenzione</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary">Backup automatico</p>
                        <p class="text-sm text-secondary">Backup giornaliero del database</p>
                    </div>
                    <button class="relative inline-flex h-6 w-11 items-center rounded-full bg-orange-600">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition translate-x-5"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary">Pulizia log</p>
                        <p class="text-sm text-secondary">Elimina log vecchi di 30 giorni</p>
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