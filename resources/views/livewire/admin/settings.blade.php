<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Impostazioni Globali</h2>
        <p class="mt-1 text-sm text-gray-600">
            Configura le impostazioni generali della piattaforma
        </p>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
            <button wire:click="setActiveTab('general')" 
                    class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Generali
            </button>
            <button wire:click="setActiveTab('notifications')" 
                    class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'notifications' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Notifiche
            </button>
            <button wire:click="setActiveTab('integrations')" 
                    class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'integrations' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Integrazioni
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="bg-white shadow rounded-lg">
        <form wire:submit.prevent="saveSettings">
            <!-- General Settings -->
            @if($activeTab === 'general')
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="app_name" class="block text-sm font-medium text-gray-700">Nome Applicazione</label>
                        <input wire:model="generalSettings.app_name.value" type="text" id="app_name" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Basketball Hub">
                        @error('generalSettings.app_name.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="timezone" class="block text-sm font-medium text-gray-700">Fuso Orario</label>
                        <select wire:model="generalSettings.timezone.value" id="timezone" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Europe/Rome">Europe/Rome (UTC+1)</option>
                            <option value="Europe/London">Europe/London (UTC+0)</option>
                            <option value="America/New_York">America/New_York (UTC-5)</option>
                            <option value="Asia/Tokyo">Asia/Tokyo (UTC+9)</option>
                        </select>
                        @error('generalSettings.timezone.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="date_format" class="block text-sm font-medium text-gray-700">Formato Data</label>
                        <select wire:model="generalSettings.date_format.value" id="date_format" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="d/m/Y">dd/mm/yyyy</option>
                            <option value="m/d/Y">mm/dd/yyyy</option>
                            <option value="Y-m-d">yyyy-mm-dd</option>
                            <option value="d-m-Y">dd-mm-yyyy</option>
                        </select>
                        @error('generalSettings.date_format.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="time_format" class="block text-sm font-medium text-gray-700">Formato Ora</label>
                        <select wire:model="generalSettings.time_format.value" id="time_format" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="H:i">24 ore (HH:mm)</option>
                            <option value="h:i A">12 ore (hh:mm AM/PM)</option>
                        </select>
                        @error('generalSettings.time_format.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="default_language" class="block text-sm font-medium text-gray-700">Lingua Predefinita</label>
                        <select wire:model="generalSettings.default_language.value" id="default_language" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="it">Italiano</option>
                            <option value="en">English</option>
                            <option value="de">Deutsch</option>
                            <option value="fr">Français</option>
                            <option value="sl">Slovenščina</option>
                        </select>
                        @error('generalSettings.default_language.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            @endif

            <!-- Notification Settings -->
            @if($activeTab === 'notifications')
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Notifiche Email</h3>
                            <p class="text-sm text-gray-500">Abilita le notifiche via email</p>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="notificationSettings.email_notifications.value" type="checkbox" id="email_notifications" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="email_notifications" class="ml-2 text-sm text-gray-700">Abilita</label>
                        </div>
                    </div>

                    @if($notificationSettings['email_notifications']['value'] ?? false)
                    <div>
                        <label for="notification_email" class="block text-sm font-medium text-gray-700">Email Notifiche</label>
                        <input wire:model="notificationSettings.notification_email.value" type="email" id="notification_email" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="notifiche@brackethoophub.com">
                        @error('notificationSettings.notification_email.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Notifiche SMS</h3>
                            <p class="text-sm text-gray-500">Abilita le notifiche via SMS</p>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="notificationSettings.sms_notifications.value" type="checkbox" id="sms_notifications" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="sms_notifications" class="ml-2 text-sm text-gray-700">Abilita</label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Integration Settings -->
            @if($activeTab === 'integrations')
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="google_analytics_id" class="block text-sm font-medium text-gray-700">Google Analytics ID</label>
                        <input wire:model="integrationSettings.google_analytics_id.value" type="text" id="google_analytics_id" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="G-XXXXXXXXXX">
                        <p class="mt-1 text-xs text-gray-500">Inserisci l'ID di Google Analytics per il tracking</p>
                        @error('integrationSettings.google_analytics_id.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="facebook_pixel_id" class="block text-sm font-medium text-gray-700">Facebook Pixel ID</label>
                        <input wire:model="integrationSettings.facebook_pixel_id.value" type="text" id="facebook_pixel_id" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="XXXXXXXXXX">
                        <p class="mt-1 text-xs text-gray-500">Inserisci l'ID del Facebook Pixel per il tracking</p>
                        @error('integrationSettings.facebook_pixel_id.value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            @endif

            <!-- Save Button -->
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="btn btn-primary">
                    Salva Impostazioni
                </button>
            </div>
        </form>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('message'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('message') }}
    </div>
    @endif
</div> 