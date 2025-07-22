@extends('layouts.admin')

@section('title', __('admin.tournament_wizard') . ' - ' . __('admin.step') . ' 4')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between text-sm font-medium text-gray-600 mb-2">
            <span>{{ __('admin.step') }} 4 {{ __('admin.of') }} 5: {{ __('admin.venues_setup') }}</span>
            <span>80%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-orange-500 h-2 rounded-full transition-all duration-300" style="width: 80%"></div>
        </div>
    </div>

    <!-- Wizard Card -->
    <div class="stat-card p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ __('admin.venues_setup') }}</h1>
            <p class="text-secondary">Configura le palestre dove si svolgerà il torneo</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Errori di validazione:</h3>
                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.tournaments.wizard.store.step4') }}" method="POST" id="venuesForm">
            @csrf
            
            <!-- Venues Container -->
            <div id="venuesContainer" class="space-y-6 mb-8">
                @php
                    $existingVenues = old('venues', $wizardData['step4']['venues'] ?? []);
                    if (empty($existingVenues)) {
                        $existingVenues = [[]]; // Almeno una palestra di default
                    }
                @endphp
                
                @foreach($existingVenues as $index => $venue)
                    <div class="venue-item border border-gray-200 rounded-lg p-6 relative" data-index="{{ $index }}">
                        <!-- Remove Button -->
                        @if($index > 0)
                            <button type="button" class="remove-venue absolute top-4 right-4 p-2 text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        @endif

                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-medium text-orange-600">{{ $index + 1 }}</span>
                            </div>
                            <h3 class="text-lg font-medium text-primary">{{ __('admin.venue') }} {{ $index + 1 }}</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome Palestra -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="venues[{{ $index }}][name]" 
                                       value="{{ $venue['name'] ?? '' }}"
                                       placeholder="Es. PalaSport Comunale, Palestra Scuola..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                       required>
                            </div>

                            <!-- Indirizzo -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_address') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="venues[{{ $index }}][address]" 
                                       value="{{ $venue['address'] ?? '' }}"
                                       placeholder="Via Roma 123"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                       required>
                            </div>

                            <!-- Città -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_city') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="venues[{{ $index }}][city]" 
                                       value="{{ $venue['city'] ?? '' }}"
                                       placeholder="Roma"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                       required>
                            </div>

                            <!-- CAP -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_postal_code') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <input type="text" 
                                       name="venues[{{ $index }}][postal_code]" 
                                       value="{{ $venue['postal_code'] ?? '' }}"
                                       placeholder="00100"
                                       maxlength="10"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>

                            <!-- Telefono -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_phone') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <input type="tel" 
                                       name="venues[{{ $index }}][phone]" 
                                       value="{{ $venue['phone'] ?? '' }}"
                                       placeholder="+39 06 123456"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>

                            <!-- Capienza -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_capacity') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <div class="relative">
                                    <input type="number" 
                                           name="venues[{{ $index }}][capacity]" 
                                           value="{{ $venue['capacity'] ?? '' }}"
                                           min="1"
                                           placeholder="200"
                                           class="w-full px-4 py-3 pr-20 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                                    <span class="absolute right-3 top-3 text-sm text-gray-500">{{ __('admin.spectators') }}</span>
                                </div>
                            </div>

                            <!-- Descrizione -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.venue_description') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <textarea name="venues[{{ $index }}][description]" 
                                          rows="3"
                                          placeholder="Note sulla palestra, servizi disponibili, parcheggio..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">{{ $venue['description'] ?? '' }}</textarea>
                            </div>

                            <!-- Disponibilità Orari -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-4">
                                    {{ __('admin.availability') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        $days = [
                                            'monday' => __('admin.monday'),
                                            'tuesday' => __('admin.tuesday'),
                                            'wednesday' => __('admin.wednesday'),
                                            'thursday' => __('admin.thursday'),
                                            'friday' => __('admin.friday'),
                                            'saturday' => __('admin.saturday'),
                                            'sunday' => __('admin.sunday'),
                                        ];
                                    @endphp
                                    
                                    @foreach($days as $dayKey => $dayName)
                                        <div class="space-y-2">
                                            <label class="block text-xs font-medium text-gray-600">{{ $dayName }}</label>
                                            <div class="space-y-1">
                                                @php
                                                    $dayAvailability = $venue['availability'][$dayKey] ?? [''];
                                                    if (empty($dayAvailability)) $dayAvailability = [''];
                                                @endphp
                                                
                                                @foreach($dayAvailability as $timeSlotIndex => $timeSlot)
                                                    <div class="flex items-center space-x-2">
                                                        <input type="text" 
                                                               name="venues[{{ $index }}][availability][{{ $dayKey }}][]" 
                                                               value="{{ $timeSlot }}"
                                                               placeholder="09:00-12:00"
                                                               pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]-([0-1]?[0-9]|2[0-3]):[0-5][0-9]$"
                                                               class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-orange-500 focus:border-transparent transition-colors">
                                                        @if($timeSlotIndex > 0)
                                                            <button type="button" class="remove-time-slot p-1 text-red-400 hover:text-red-600">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                
                                                <button type="button" class="add-time-slot text-xs text-orange-600 hover:text-orange-700 flex items-center" data-day="{{ $dayKey }}" data-venue="{{ $index }}">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    Aggiungi orario
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Formato: HH:MM-HH:MM (es. 09:00-12:00)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Venue Button -->
            <div class="text-center mb-8">
                <button type="button" 
                        id="addVenue"
                        class="px-6 py-3 border-2 border-dashed border-orange-300 text-orange-600 hover:border-orange-500 hover:text-orange-700 rounded-lg transition-colors flex items-center mx-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    {{ __('admin.add_venue') }}
                </button>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.tournaments.wizard.step3') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('admin.previous_step') }}
                </a>
                
                <button type="submit" 
                        class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors flex items-center">
                    {{ __('admin.next_step') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let venueIndex = {{ count($existingVenues) }};

// Template per nuova palestra
function getVenueTemplate(index) {
    return `
        <div class="venue-item border border-gray-200 rounded-lg p-6 relative" data-index="${index}">
            <button type="button" class="remove-venue absolute top-4 right-4 p-2 text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-sm font-medium text-orange-600">${index + 1}</span>
                </div>
                <h3 class="text-lg font-medium text-primary">{{ __('admin.venue') }} ${index + 1}</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="venues[${index}][name]" 
                           placeholder="Es. PalaSport Comunale, Palestra Scuola..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_address') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="venues[${index}][address]" 
                           placeholder="Via Roma 123"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_city') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="venues[${index}][city]" 
                           placeholder="Roma"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_postal_code') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="text" 
                           name="venues[${index}][postal_code]" 
                           placeholder="00100"
                           maxlength="10"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_phone') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="tel" 
                           name="venues[${index}][phone]" 
                           placeholder="+39 06 123456"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_capacity') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               name="venues[${index}][capacity]" 
                               min="1"
                               placeholder="200"
                               class="w-full px-4 py-3 pr-20 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        <span class="absolute right-3 top-3 text-sm text-gray-500">{{ __('admin.spectators') }}</span>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.venue_description') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <textarea name="venues[${index}][description]" 
                              rows="3"
                              placeholder="Note sulla palestra, servizi disponibili, parcheggio..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"></textarea>
                </div>
            </div>
        </div>
    `;
}

// Aggiungi palestra
document.getElementById('addVenue').addEventListener('click', function() {
    const container = document.getElementById('venuesContainer');
    const newVenue = document.createElement('div');
    newVenue.innerHTML = getVenueTemplate(venueIndex);
    container.appendChild(newVenue.firstElementChild);
    venueIndex++;
    updateVenueNumbers();
});

// Rimuovi palestra
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-venue')) {
        const venueItem = e.target.closest('.venue-item');
        if (document.querySelectorAll('.venue-item').length > 1) {
            venueItem.remove();
            updateVenueNumbers();
        }
    }
});

// Aggiungi slot orario
document.addEventListener('click', function(e) {
    if (e.target.closest('.add-time-slot')) {
        const button = e.target.closest('.add-time-slot');
        const day = button.dataset.day;
        const venueIndex = button.dataset.venue;
        
        const timeSlotHtml = `
            <div class="flex items-center space-x-2">
                <input type="text" 
                       name="venues[${venueIndex}][availability][${day}][]" 
                       placeholder="09:00-12:00"
                       pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]-([0-1]?[0-9]|2[0-3]):[0-5][0-9]$"
                       class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-orange-500 focus:border-transparent transition-colors">
                <button type="button" class="remove-time-slot p-1 text-red-400 hover:text-red-600">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        
        button.insertAdjacentHTML('beforebegin', timeSlotHtml);
    }
});

// Rimuovi slot orario
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-time-slot')) {
        e.target.closest('.flex').remove();
    }
});

// Aggiorna numerazione palestre
function updateVenueNumbers() {
    const venues = document.querySelectorAll('.venue-item');
    venues.forEach((venue, index) => {
        venue.dataset.index = index;
        const numberElement = venue.querySelector('.bg-orange-100 span');
        const titleElement = venue.querySelector('h3');
        if (numberElement) numberElement.textContent = index + 1;
        if (titleElement) titleElement.textContent = `{{ __('admin.venue') }} ${index + 1}`;
        
        // Aggiorna i name degli input
        const inputs = venue.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/venues\[\d+\]/, `venues[${index}]`);
                input.setAttribute('name', newName);
            }
        });
        
        // Aggiorna data-venue nei pulsanti add-time-slot
        const addButtons = venue.querySelectorAll('.add-time-slot');
        addButtons.forEach(button => {
            button.dataset.venue = index;
        });
    });
}
</script>
@endsection 