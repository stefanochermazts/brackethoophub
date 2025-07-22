@extends('layouts.admin')

@section('title', $tournament->name . ' - ' . __('admin.tournament_details'))

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary">{{ $tournament->name }}</h1>
            <div class="flex items-center space-x-4 mt-2">
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    @switch($tournament->status)
                        @case('draft') bg-yellow-100 text-yellow-800 @break
                        @case('published') bg-blue-100 text-blue-800 @break
                        @case('ongoing') bg-green-100 text-green-800 @break
                        @case('completed') bg-gray-100 text-gray-800 @break
                        @case('cancelled') bg-red-100 text-red-800 @break
                    @endswitch">
                    {{ __('admin.' . $tournament->status) }}
                </span>
                <span class="text-sm text-secondary">
                    {{ __('admin.created_at') }}: {{ $tournament->created_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.tournaments.index') }}" 
               class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('admin.back_to_tournaments') }}
            </a>
            
            @can('update', $tournament)
                <a href="{{ route('admin.tournaments.edit', $tournament) }}" 
                   class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    {{ __('admin.edit_tournament') }}
                </a>
            @endcan
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-green-800">{{ session('success') }}</h3>
                </div>
            </div>
        </div>
    @endif

    <!-- Tournament Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-6 text-center">
            <div class="text-3xl font-bold text-blue-600 mb-2">{{ $tournament->categories->count() }}</div>
            <div class="text-sm text-secondary">{{ __('admin.categories') }}</div>
        </div>
        <div class="stat-card p-6 text-center">
            <div class="text-3xl font-bold text-green-600 mb-2">{{ $tournament->total_teams }}</div>
            <div class="text-sm text-secondary">{{ __('admin.teams') }}</div>
        </div>
        <div class="stat-card p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 mb-2">{{ $tournament->venues->count() }}</div>
            <div class="text-sm text-secondary">{{ __('admin.venues') }}</div>
        </div>
        <div class="stat-card p-6 text-center">
            <div class="text-3xl font-bold text-orange-600 mb-2">
                {{ $tournament->start_date->diffInDays($tournament->end_date) + 1 }}
            </div>
            <div class="text-sm text-secondary">Giorni</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Tournament Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="stat-card p-6">
                <h2 class="text-xl font-semibold text-primary mb-4">{{ __('admin.tournament_info') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-secondary mb-1">{{ __('admin.tournament_gender') }}</h3>
                        <p class="text-primary">{{ $tournament->gender_display }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-secondary mb-1">{{ __('admin.tournament_format') }}</h3>
                        <p class="text-primary">
                            @switch($tournament->format)
                                @case('round_robin') {{ __('admin.round_robin') }} @break
                                @case('knockout') {{ __('admin.knockout') }} @break
                                @case('mixed') {{ __('admin.mixed_format') }} @break
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-secondary mb-1">{{ __('admin.start_date') }}</h3>
                        <p class="text-primary">{{ $tournament->start_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-secondary mb-1">{{ __('admin.end_date') }}</h3>
                        <p class="text-primary">{{ $tournament->end_date->format('d/m/Y') }}</p>
                    </div>
                    @if($tournament->description)
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-secondary mb-1">{{ __('admin.tournament_description') }}</h3>
                            <p class="text-primary">{{ $tournament->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Categories -->
            <div class="stat-card p-6">
                <h2 class="text-xl font-semibold text-primary mb-4">{{ __('admin.categories') }}</h2>
                <div class="space-y-4">
                    @forelse($tournament->categories as $category)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-medium text-primary">{{ $category->name }}</h3>
                                <span class="text-sm bg-gray-100 px-2 py-1 rounded">
                                    {{ $category->teams_count }} squadre
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-secondary">Sesso:</span>
                                    <span class="text-primary ml-1">{{ $category->gender_display }}</span>
                                </div>
                                @if($category->age_range)
                                    <div>
                                        <span class="text-secondary">{{ __('admin.age_range') }}:</span>
                                        <span class="text-primary ml-1">{{ $category->age_range }}</span>
                                    </div>
                                @endif
                                <div>
                                    <span class="text-secondary">Formula:</span>
                                    <span class="text-primary ml-1">
                                        @switch($category->format)
                                            @case('round_robin') Girone @break
                                            @case('knockout') Eliminazione @break
                                            @case('mixed') Misto @break
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            @if($category->description)
                                <p class="text-sm text-secondary mt-2">{{ $category->description }}</p>
                            @endif

                            <!-- Teams -->
                            @if($category->teams->count() > 0)
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-secondary mb-2">Squadre iscritte:</h4>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach($category->teams as $team)
                                            <div class="bg-gray-50 rounded px-3 py-2 text-sm">
                                                <div class="font-medium text-primary">{{ $team->name }}</div>
                                                @if($team->short_name)
                                                    <div class="text-xs text-secondary">{{ $team->short_name }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-secondary text-center py-4">Nessuna categoria configurata</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Tournament Status -->
            <div class="stat-card p-6">
                <h2 class="text-xl font-semibold text-primary mb-4">{{ __('admin.tournament_status') }}</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-secondary">{{ __('admin.organizer') }}:</span>
                        <span class="text-primary">{{ $tournament->organizer->name }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-secondary">Stato:</span>
                        <span class="px-2 py-1 rounded text-xs font-medium
                            @switch($tournament->status)
                                @case('draft') bg-yellow-100 text-yellow-800 @break
                                @case('published') bg-blue-100 text-blue-800 @break
                                @case('ongoing') bg-green-100 text-green-800 @break
                                @case('completed') bg-gray-100 text-gray-800 @break
                                @case('cancelled') bg-red-100 text-red-800 @break
                            @endswitch">
                            {{ __('admin.' . $tournament->status) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-secondary">{{ __('admin.created_at') }}:</span>
                        <span class="text-primary text-sm">{{ $tournament->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                @if($tournament->status === 'draft')
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <button class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                            {{ __('admin.publish_tournament') }}
                        </button>
                    </div>
                @endif
            </div>

            <!-- Venues -->
            <div class="stat-card p-6">
                <h2 class="text-xl font-semibold text-primary mb-4">{{ __('admin.venues') }}</h2>
                <div class="space-y-3">
                    @forelse($tournament->venues as $venue)
                        <div class="border border-gray-100 rounded-lg p-3">
                            <h3 class="font-medium text-primary text-sm">{{ $venue->name }}</h3>
                            <p class="text-xs text-secondary mt-1">{{ $venue->full_address }}</p>
                            @if($venue->phone)
                                <p class="text-xs text-secondary">{{ $venue->phone }}</p>
                            @endif
                            @if($venue->capacity)
                                <p class="text-xs text-secondary">{{ $venue->capacity }} {{ __('admin.spectators') }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-secondary text-sm">Nessuna palestra configurata</p>
                    @endforelse
                </div>
            </div>

            <!-- Actions -->
            @can('delete', $tournament)
                <div class="stat-card p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-4">Zona Pericolosa</h2>
                    <button onclick="confirmDelete()" 
                            class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        {{ __('admin.delete_tournament') }}
                    </button>
                </div>
            @endcan
        </div>
    </div>
</div>

@can('delete', $tournament)
<script>
function confirmDelete() {
    if (confirm('Sei sicuro di voler eliminare questo torneo? Questa azione non può essere annullata.')) {
        // Crea un form per l'eliminazione
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.tournaments.destroy', $tournament) }}';
        
        // Aggiungi token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Aggiungi method spoofing per DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endcan
@endsection 