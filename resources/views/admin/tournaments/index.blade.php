@extends('layouts.admin')

@section('title', __('admin.tournament_management'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-primary">{{ __('admin.tournament_management') }}</h1>
            <p class="text-secondary">{{ __('admin.manage_platform_tournaments') }}</p>
        </div>
        <a href="{{ route('admin.tournaments.wizard.step1') }}" 
           class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            {{ __('admin.new_tournament') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <p class="text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Tournaments Grid -->
    @if($tournaments->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tournaments as $tournament)
                <div class="stat-card p-6 hover:shadow-lg transition-all duration-300 group">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full 
                                {{ $tournament->status === 'published' ? 'bg-green-500' : 
                                   ($tournament->status === 'ongoing' ? 'bg-blue-500' : 
                                   ($tournament->status === 'completed' ? 'bg-gray-500' : 'bg-yellow-500')) }}">
                            </div>
                            <span class="text-xs font-medium px-2 py-1 rounded-full
                                {{ $tournament->status === 'published' ? 'bg-green-100 text-green-800' : 
                                   ($tournament->status === 'ongoing' ? 'bg-blue-100 text-blue-800' : 
                                   ($tournament->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ $tournament->status_display }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.tournaments.show', $tournament) }}" 
                               class="p-2 text-gray-400 hover:text-orange-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            @if($tournament->organizer_id === auth()->id() || auth()->user()->isAdmin())
                                <a href="{{ route('admin.tournaments.edit', $tournament) }}" 
                                   class="p-2 text-gray-400 hover:text-blue-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Tournament Info -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-primary mb-2 group-hover:text-orange-500 transition-colors line-clamp-2">
                            {{ $tournament->name }}
                        </h3>
                        @if($tournament->description)
                            <p class="text-sm text-secondary line-clamp-2 mb-3">{{ $tournament->description }}</p>
                        @endif
                        
                        <div class="flex items-center space-x-4 text-sm text-secondary">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $tournament->gender_display }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $tournament->start_date->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-4 pt-4 border-t border-gray-100">
                        <div class="text-center">
                            <div class="text-lg font-bold text-primary">{{ $tournament->categories->count() }}</div>
                            <div class="text-xs text-secondary">Categorie</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-primary">{{ $tournament->total_teams }}</div>
                            <div class="text-xs text-secondary">Squadre</div>
                        </div>
                    </div>

                    <!-- Organizer -->
                    @if(auth()->user()->isAdmin())
                        <div class="flex items-center text-xs text-secondary">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Organizzatore: {{ $tournament->organizer->name }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($tournaments->hasPages())
            <div class="flex justify-center">
                {{ $tournaments->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="stat-card p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-primary mb-2">Nessun torneo trovato</h3>
            <p class="text-secondary mb-6">Inizia creando il tuo primo torneo</p>
            <a href="{{ route('admin.tournaments.wizard.step1') }}" 
               class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                {{ __('admin.new_tournament') }}
            </a>
        </div>
    @endif
</div>
@endsection 