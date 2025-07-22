@extends('layouts.admin')

@section('title', __('admin.tournament_wizard') . ' - ' . __('admin.step') . ' 3')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between text-sm font-medium text-gray-600 mb-2">
            <span>{{ __('admin.step') }} 3 {{ __('admin.of') }} 5: {{ __('admin.teams_management') }}</span>
            <span>60%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-orange-500 h-2 rounded-full transition-all duration-300" style="width: 60%"></div>
        </div>
    </div>

    <!-- Wizard Card -->
    <div class="stat-card p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ __('admin.teams_management') }}</h1>
            <p class="text-secondary">Aggiungi le squadre per ogni categoria del torneo</p>
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

        <form action="{{ route('admin.tournaments.wizard.store.step3') }}" method="POST" id="teamsForm">
            @csrf
            
            <!-- Categories with Teams -->
            <div class="space-y-8">
                @foreach($wizardData['step2']['categories'] as $categoryIndex => $category)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Category Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-primary">{{ $category['name'] }}</h3>
                                    <div class="flex items-center space-x-4 text-sm text-secondary mt-1">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            @switch($category['gender'])
                                                @case('male') {{ __('admin.male') }} @break
                                                @case('female') {{ __('admin.female') }} @break
                                                @case('mixed') {{ __('admin.mixed') }} @break
                                            @endswitch
                                        </span>
                                        @if($category['min_age'] || $category['max_age'])
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                @if($category['min_age'] && $category['max_age'])
                                                    Età {{ $category['min_age'] }}-{{ $category['max_age'] }}
                                                @elseif($category['min_age'])
                                                    Età {{ $category['min_age'] }}+
                                                @elseif($category['max_age'])
                                                    Età fino a {{ $category['max_age'] }}
                                                @endif
                                            </span>
                                        @endif
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            Min: {{ $category['min_teams'] }} squadre
                                            @if($category['max_teams'])
                                                / Max: {{ $category['max_teams'] }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-medium text-gray-500">Squadre aggiunte:</span>
                                    <span class="category-team-count bg-orange-100 text-orange-800 text-sm font-medium px-2 py-1 rounded-full ml-1" data-category="{{ $categoryIndex }}">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Teams Container -->
                        <div class="p-6">
                            <div class="teams-container space-y-4" data-category="{{ $categoryIndex }}">
                                @php
                                    $existingTeams = old("teams.category_$categoryIndex", $wizardData['step3']['teams']["category_$categoryIndex"] ?? []);
                                    if (empty($existingTeams)) {
                                        // Aggiungi il numero minimo di squadre per questa categoria
                                        $minTeams = (int) $category['min_teams'];
                                        for ($i = 0; $i < $minTeams; $i++) {
                                            $existingTeams[] = [];
                                        }
                                    }
                                @endphp
                                
                                @foreach($existingTeams as $teamIndex => $team)
                                    <div class="team-item bg-white border border-gray-200 rounded-lg p-4 relative" data-team="{{ $teamIndex }}">
                                        @if($teamIndex >= $category['min_teams'])
                                            <button type="button" class="remove-team absolute top-2 right-2 p-1 text-red-400 hover:text-red-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        @endif

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                            <!-- Nome Squadra -->
                                            <div class="lg:col-span-2">
                                                <label class="block text-sm font-medium text-primary mb-2">
                                                    {{ __('admin.team_name') }} <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="teams[category_{{ $categoryIndex }}][{{ $teamIndex }}][name]" 
                                                       value="{{ $team['name'] ?? '' }}"
                                                       placeholder="Nome della squadra"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                                       required>
                                            </div>

                                            <!-- Nome Abbreviato -->
                                            <div>
                                                <label class="block text-sm font-medium text-primary mb-2">
                                                    {{ __('admin.team_short_name') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                                </label>
                                                <input type="text" 
                                                       name="teams[category_{{ $categoryIndex }}][{{ $teamIndex }}][short_name]" 
                                                       value="{{ $team['short_name'] ?? '' }}"
                                                       placeholder="Es. ABC"
                                                       maxlength="20"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                                            </div>

                                            <!-- Società -->
                                            <div>
                                                <label class="block text-sm font-medium text-primary mb-2">
                                                    {{ __('admin.team_company') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                                </label>
                                                <select name="teams[category_{{ $categoryIndex }}][{{ $teamIndex }}][company_id]"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                                                    <option value="">{{ __('admin.no_company') }}</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}" {{ ($team['company_id'] ?? '') == $company->id ? 'selected' : '' }}>
                                                            {{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Allenatore -->
                                            <div class="lg:col-span-2">
                                                <label class="block text-sm font-medium text-primary mb-2">
                                                    {{ __('admin.team_coach') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                                </label>
                                                <select name="teams[category_{{ $categoryIndex }}][{{ $teamIndex }}][coach_id]"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                                                    <option value="">{{ __('admin.no_coach') }}</option>
                                                    @foreach($coaches as $coach)
                                                        <option value="{{ $coach->id }}" {{ ($team['coach_id'] ?? '') == $coach->id ? 'selected' : '' }}>
                                                            {{ $coach->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Team Button -->
                            <div class="mt-4">
                                <button type="button" 
                                        class="add-team w-full px-4 py-3 border-2 border-dashed border-gray-300 text-gray-600 hover:border-orange-300 hover:text-orange-600 rounded-lg transition-colors flex items-center justify-center"
                                        data-category="{{ $categoryIndex }}"
                                        @if($category['max_teams'] && count($existingTeams) >= $category['max_teams']) disabled @endif>
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    {{ __('admin.add_team') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-200 mt-8">
                <a href="{{ route('admin.tournaments.wizard.step2') }}" 
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
// Template per nuova squadra
function getTeamTemplate(categoryIndex, teamIndex) {
    return `
        <div class="team-item bg-white border border-gray-200 rounded-lg p-4 relative" data-team="${teamIndex}">
            <button type="button" class="remove-team absolute top-2 right-2 p-1 text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.team_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="teams[category_${categoryIndex}][${teamIndex}][name]" 
                           placeholder="Nome della squadra"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.team_short_name') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="text" 
                           name="teams[category_${categoryIndex}][${teamIndex}][short_name]" 
                           placeholder="Es. ABC"
                           maxlength="20"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.team_company') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <select name="teams[category_${categoryIndex}][${teamIndex}][company_id]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        <option value="">{{ __('admin.no_company') }}</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.team_coach') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <select name="teams[category_${categoryIndex}][${teamIndex}][coach_id]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        <option value="">{{ __('admin.no_coach') }}</option>
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    `;
}

// Contatori squadre per categoria
const teamCounters = {};

// Inizializza contatori
document.querySelectorAll('.teams-container').forEach(container => {
    const categoryIndex = container.dataset.category;
    teamCounters[categoryIndex] = container.querySelectorAll('.team-item').length;
    updateTeamCount(categoryIndex);
});

// Aggiungi squadra
document.addEventListener('click', function(e) {
    if (e.target.closest('.add-team')) {
        const button = e.target.closest('.add-team');
        const categoryIndex = button.dataset.category;
        const container = document.querySelector(`.teams-container[data-category="${categoryIndex}"]`);
        const teamIndex = teamCounters[categoryIndex];
        
        const newTeam = document.createElement('div');
        newTeam.innerHTML = getTeamTemplate(categoryIndex, teamIndex);
        container.appendChild(newTeam.firstElementChild);
        
        teamCounters[categoryIndex]++;
        updateTeamCount(categoryIndex);
        
        // Controlla se ha raggiunto il limite massimo
        const categoryData = @json($wizardData['step2']['categories']);
        const maxTeams = categoryData[categoryIndex]?.max_teams;
        if (maxTeams && teamCounters[categoryIndex] >= maxTeams) {
            button.disabled = true;
            button.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
});

// Rimuovi squadra
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-team')) {
        const teamItem = e.target.closest('.team-item');
        const container = teamItem.closest('.teams-container');
        const categoryIndex = container.dataset.category;
        
        teamItem.remove();
        teamCounters[categoryIndex]--;
        updateTeamCount(categoryIndex);
        
        // Riabilita il pulsante aggiungi se era disabilitato
        const addButton = container.parentElement.querySelector('.add-team');
        addButton.disabled = false;
        addButton.classList.remove('opacity-50', 'cursor-not-allowed');
        
        // Ricalcola gli indici
        updateTeamIndices(categoryIndex);
    }
});

// Aggiorna contatore squadre
function updateTeamCount(categoryIndex) {
    const countElement = document.querySelector(`.category-team-count[data-category="${categoryIndex}"]`);
    if (countElement) {
        countElement.textContent = teamCounters[categoryIndex];
    }
}

// Aggiorna indici squadre dopo rimozione
function updateTeamIndices(categoryIndex) {
    const container = document.querySelector(`.teams-container[data-category="${categoryIndex}"]`);
    const teams = container.querySelectorAll('.team-item');
    
    teams.forEach((team, index) => {
        team.dataset.team = index;
        
        // Aggiorna i name degli input
        const inputs = team.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/\[\d+\](?=\])/, `[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
}

// Aggiorna contatori iniziali
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.teams-container').forEach(container => {
        const categoryIndex = container.dataset.category;
        updateTeamCount(categoryIndex);
    });
});
</script>
@endsection 