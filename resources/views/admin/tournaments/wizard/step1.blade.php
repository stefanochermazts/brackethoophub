@extends('layouts.admin')

@section('title', __('admin.tournament_wizard') . ' - ' . __('admin.step') . ' 1')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between text-sm font-medium text-gray-600 mb-2">
            <span>{{ __('admin.step') }} 1 {{ __('admin.of') }} 5: {{ __('admin.basic_information') }}</span>
            <span>20%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-orange-500 h-2 rounded-full transition-all duration-300" style="width: 20%"></div>
        </div>
    </div>

    <!-- Wizard Card -->
    <div class="stat-card p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ __('admin.tournament_wizard') }}</h1>
            <p class="text-secondary">{{ __('admin.basic_information') }}</p>
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

        <form action="{{ route('admin.tournaments.wizard.store.step1') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nome Torneo -->
            <div>
                <label for="name" class="block text-sm font-medium text-primary mb-2">
                    {{ __('admin.tournament_name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $wizardData['step1']['name'] ?? '') }}"
                       placeholder="Es. Torneo Estivo 2024"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descrizione -->
            <div>
                <label for="description" class="block text-sm font-medium text-primary mb-2">
                    {{ __('admin.tournament_description') }}
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          placeholder="Descrizione del torneo, regole speciali, premi..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">{{ old('description', $wizardData['step1']['description'] ?? '') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid per Sesso e Date -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sesso Torneo -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.tournament_gender') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="gender" 
                            name="gender"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                            required>
                        <option value="">Seleziona...</option>
                        <option value="male" {{ old('gender', $wizardData['step1']['gender'] ?? '') == 'male' ? 'selected' : '' }}>
                            {{ __('admin.male') }}
                        </option>
                        <option value="female" {{ old('gender', $wizardData['step1']['gender'] ?? '') == 'female' ? 'selected' : '' }}>
                            {{ __('admin.female') }}
                        </option>
                        <option value="mixed" {{ old('gender', $wizardData['step1']['gender'] ?? '') == 'mixed' ? 'selected' : '' }}>
                            {{ __('admin.mixed') }}
                        </option>
                    </select>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Inizio -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.start_date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="start_date" 
                           name="start_date" 
                           value="{{ old('start_date', $wizardData['step1']['start_date'] ?? '') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Fine -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.end_date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="end_date" 
                           name="end_date" 
                           value="{{ old('end_date', $wizardData['step1']['end_date'] ?? '') }}"
                           min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Formula Torneo -->
            <div>
                <label class="block text-sm font-medium text-primary mb-4">
                    {{ __('admin.tournament_format') }} <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Round Robin -->
                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="format" 
                               value="round_robin" 
                               {{ old('format', $wizardData['step1']['format'] ?? '') == 'round_robin' ? 'checked' : '' }}
                               class="sr-only peer" 
                               required>
                        <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 relative">
                                    <div class="hidden peer-checked:block absolute inset-1 bg-white rounded-full"></div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-primary">{{ __('admin.round_robin') }}</h3>
                                    <p class="text-sm text-secondary">Ogni squadra gioca contro tutte le altre</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Knockout -->
                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="format" 
                               value="knockout" 
                               {{ old('format', $wizardData['step1']['format'] ?? '') == 'knockout' ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 relative">
                                    <div class="hidden peer-checked:block absolute inset-1 bg-white rounded-full"></div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-primary">{{ __('admin.knockout') }}</h3>
                                    <p class="text-sm text-secondary">Eliminazione diretta</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Mixed -->
                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="format" 
                               value="mixed" 
                               {{ old('format', $wizardData['step1']['format'] ?? '') == 'mixed' ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 relative">
                                    <div class="hidden peer-checked:block absolute inset-1 bg-white rounded-full"></div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-primary">{{ __('admin.mixed_format') }}</h3>
                                    <p class="text-sm text-secondary">Gironi + fase finale</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                @error('format')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.tournaments.index') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 transition-colors">
                    {{ __('admin.cancel_wizard') }}
                </a>
                
                <button type="submit" 
                        class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors">
                    {{ __('admin.next_step') }}
                    <svg class="w-5 h-5 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Aggiorna automaticamente la data minima di fine quando cambia quella di inizio
document.getElementById('start_date').addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDateInput = document.getElementById('end_date');
    
    if (startDate) {
        const minEndDate = new Date(startDate);
        minEndDate.setDate(minEndDate.getDate() + 1);
        endDateInput.min = minEndDate.toISOString().split('T')[0];
        
        // Se la data di fine è precedente a quella di inizio, la resetta
        if (endDateInput.value && new Date(endDateInput.value) <= startDate) {
            endDateInput.value = '';
        }
    }
});
</script>
@endsection 