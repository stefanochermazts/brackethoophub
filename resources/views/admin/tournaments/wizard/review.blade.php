@extends('layouts.admin')

@section('title', __('admin.tournament_wizard') . ' - ' . __('admin.review_and_save'))

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between text-sm font-medium text-gray-600 mb-2">
            <span>{{ __('admin.step') }} 5 {{ __('admin.of') }} 5: {{ __('admin.review_and_save') }}</span>
            <span>100%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-500 h-2 rounded-full transition-all duration-300" style="width: 100%"></div>
        </div>
    </div>

    <!-- Review Card -->
    <div class="stat-card p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ __('admin.tournament_summary') }}</h1>
            <p class="text-secondary">{{ __('admin.review_data') }}</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ count($wizardData['step2']['categories']) }}</div>
                <div class="text-sm text-blue-600">{{ __('admin.total_categories') }}</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">
                    @php
                        $totalTeams = 0;
                        foreach($wizardData['step3']['teams'] as $categoryTeams) {
                            $totalTeams += count($categoryTeams);
                        }
                    @endphp
                    {{ $totalTeams }}
                </div>
                <div class="text-sm text-green-600">{{ __('admin.total_teams') }}</div>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600">{{ count($wizardData['step4']['venues']) }}</div>
                <div class="text-sm text-purple-600">{{ __('admin.total_venues') }}</div>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-lg">
                <div class="text-2xl font-bold text-orange-600">
                    {{ \Carbon\Carbon::parse($wizardData['step1']['start_date'])->diffInDays(\Carbon\Carbon::parse($wizardData['step1']['end_date'])) + 1 }}
                </div>
                <div class="text-sm text-orange-600">Giorni durata</div>
            </div>
        </div>

        <!-- Review Sections -->
        <div class="space-y-8">
            <!-- Step 1: Basic Information -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-primary">{{ __('admin.basic_info') }}</h3>
                    <a href="{{ route('admin.tournaments.wizard.step1') }}" 
                       class="text-sm text-orange-600 hover:text-orange-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('admin.edit_step') }}
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-primary mb-2">{{ __('admin.tournament_name') }}</h4>
                            <p class="text-gray-600">{{ $wizardData['step1']['name'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary mb-2">{{ __('admin.tournament_gender') }}</h4>
                            <p class="text-gray-600">
                                @switch($wizardData['step1']['gender'])
                                    @case('male') {{ __('admin.male') }} @break
                                    @case('female') {{ __('admin.female') }} @break
                                    @case('mixed') {{ __('admin.mixed') }} @break
                                @endswitch
                            </p>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary mb-2">{{ __('admin.start_date') }}</h4>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($wizardData['step1']['start_date'])->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary mb-2">{{ __('admin.end_date') }}</h4>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($wizardData['step1']['end_date'])->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary mb-2">{{ __('admin.tournament_format') }}</h4>
                            <p class="text-gray-600">
                                @switch($wizardData['step1']['format'])
                                    @case('round_robin') {{ __('admin.round_robin') }} @break
                                    @case('knockout') {{ __('admin.knockout') }} @break
                                    @case('mixed') {{ __('admin.mixed_format') }} @break
                                @endswitch
                            </p>
                        </div>
                        @if($wizardData['step1']['description'])
                            <div class="md:col-span-2">
                                <h4 class="font-medium text-primary mb-2">{{ __('admin.tournament_description') }}</h4>
                                <p class="text-gray-600">{{ $wizardData['step1']['description'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Step 2: Categories -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-primary">{{ __('admin.categories_summary') }}</h3>
                    <a href="{{ route('admin.tournaments.wizard.step2') }}" 
                       class="text-sm text-orange-600 hover:text-orange-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('admin.edit_step') }}
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($wizardData['step2']['categories'] as $index => $category)
                            <div class="border border-gray-100 rounded-lg p-4">
                                <h4 class="font-medium text-primary mb-3">{{ $category['name'] }}</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Sesso:</span>
                                        <span class="text-gray-700">
                                            @switch($category['gender'])
                                                @case('male') {{ __('admin.male') }} @break
                                                @case('female') {{ __('admin.female') }} @break
                                                @case('mixed') {{ __('admin.mixed') }} @break
                                            @endswitch
                                        </span>
                                    </div>
                                    @if($category['min_age'] || $category['max_age'])
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Età:</span>
                                            <span class="text-gray-700">
                                                @if($category['min_age'] && $category['max_age'])
                                                    {{ $category['min_age'] }}-{{ $category['max_age'] }} anni
                                                @elseif($category['min_age'])
                                                    {{ $category['min_age'] }}+ anni
                                                @elseif($category['max_age'])
                                                    fino a {{ $category['max_age'] }} anni
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Squadre:</span>
                                        <span class="text-gray-700">
                                            {{ $category['min_teams'] }}{{ $category['max_teams'] ? '-' . $category['max_teams'] : '+' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Formula:</span>
                                        <span class="text-gray-700">
                                            @switch($category['format'])
                                                @case('round_robin') Girone @break
                                                @case('knockout') Eliminazione @break
                                                @case('mixed') Misto @break
                                            @endswitch
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Step 3: Teams -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-primary">{{ __('admin.teams_summary') }}</h3>
                    <a href="{{ route('admin.tournaments.wizard.step3') }}" 
                       class="text-sm text-orange-600 hover:text-orange-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('admin.edit_step') }}
                    </a>
                </div>
                <div class="p-6">
                    @foreach($wizardData['step2']['categories'] as $categoryIndex => $category)
                        <div class="mb-6 last:mb-0">
                            <h4 class="font-medium text-primary mb-3">{{ $category['name'] }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @php
                                    $categoryTeams = $wizardData['step3']['teams']["category_$categoryIndex"] ?? [];
                                @endphp
                                @forelse($categoryTeams as $team)
                                    <div class="bg-gray-50 rounded-lg p-3 text-sm">
                                        <div class="font-medium text-gray-900">{{ $team['name'] }}</div>
                                        @if($team['short_name'])
                                            <div class="text-gray-500 text-xs">{{ $team['short_name'] }}</div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-gray-500 text-sm">Nessuna squadra</div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Step 4: Venues -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-primary">{{ __('admin.venues_summary') }}</h3>
                    <a href="{{ route('admin.tournaments.wizard.step4') }}" 
                       class="text-sm text-orange-600 hover:text-orange-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('admin.edit_step') }}
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($wizardData['step4']['venues'] as $venue)
                            <div class="border border-gray-100 rounded-lg p-4">
                                <h4 class="font-medium text-primary mb-3">{{ $venue['name'] }}</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-start">
                                        <svg class="w-4 h-4 mt-0.5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="text-gray-700">
                                            {{ $venue['address'] }}, {{ $venue['city'] }}
                                            @if($venue['postal_code']) {{ $venue['postal_code'] }} @endif
                                        </span>
                                    </div>
                                    @if($venue['phone'])
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span class="text-gray-700">{{ $venue['phone'] }}</span>
                                        </div>
                                    @endif
                                    @if($venue['capacity'])
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <span class="text-gray-700">{{ $venue['capacity'] }} {{ __('admin.spectators') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Actions -->
        <form action="{{ route('admin.tournaments.wizard.store') }}" method="POST" class="mt-8">
            @csrf
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.tournaments.wizard.step4') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('admin.previous_step') }}
                </a>

                <div class="flex space-x-4">
                    <a href="{{ route('admin.tournaments.wizard.cancel') }}"
                       onclick="return confirm('Sei sicuro di voler annullare? Tutti i dati inseriti andranno persi.')"
                       class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        {{ __('admin.cancel_wizard') }}
                    </a>
                    
                    <button type="submit" 
                            class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('admin.create_tournament') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 