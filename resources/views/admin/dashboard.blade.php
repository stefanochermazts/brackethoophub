@extends('layouts.admin')

@section('title', auth()->user()->isAdmin() ? __('admin.administrative_dashboard') : __('admin.organizer_dashboard'))

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-primary mb-4">
            {{ auth()->user()->isAdmin() ? __('admin.administrative_dashboard') : __('admin.organizer_dashboard') }}
        </h1>
        <p class="text-lg text-secondary">
            {{ auth()->user()->isAdmin() ? __('admin.welcome_admin') : __('admin.welcome_organizer') }}
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.total_users') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $totalUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <!-- Administrators -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.administrators') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $adminUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Organizers -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.organizers') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $organizerUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        @endif

        <!-- Companies -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.companies') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $companyUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Coaches -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.coaches') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $coachUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Players -->
        <div class="stat-card group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary">{{ __('admin.players') }}</p>
                    <p class="text-3xl font-bold text-primary">{{ $playerUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-primary">{{ __('admin.quick_actions') }}</h2>
        
        <div class="grid grid-cols-1 {{ auth()->user()->isAdmin() ? 'md:grid-cols-3' : 'md:grid-cols-2' }} gap-6">
            <!-- Add User -->
            <a href="{{ route('admin.users') }}" class="stat-card p-6 hover:shadow-lg transition-all duration-300 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-primary group-hover:text-orange-500 transition-colors">
                            {{ __('admin.add_user') }}
                        </h3>
                        <p class="text-secondary">
                            @if(auth()->user()->isAdmin())
                                {{ __('admin.create_new_account') }}
                            @else
                                {{ __('admin.create_company_coach_player') }}
                            @endif
                        </p>
                    </div>
                </div>
            </a>

            <!-- Manage Tournaments -->
            <a href="{{ route('admin.tournaments.index') }}" class="stat-card p-6 hover:shadow-lg transition-all duration-300 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-primary group-hover:text-orange-500 transition-colors">
                            {{ __('admin.manage_tournaments') }}
                        </h3>
                        <p class="text-secondary">{{ __('admin.view_modify_tournaments') }}</p>
                    </div>
                </div>
            </a>

            <!-- Settings (Only for Admin) -->
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.settings') }}" class="stat-card p-6 hover:shadow-lg transition-all duration-300 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-primary group-hover:text-orange-500 transition-colors">
                            {{ __('admin.settings') }}
                        </h3>
                        <p class="text-secondary">{{ __('admin.configure_platform') }}</p>
                    </div>
                </div>
            </a>
            @endif
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-primary mb-4">{{ __('admin.recent_activity') }}</h2>
        <div class="stat-card p-6">
            <div class="space-y-4">
                @if($recentUsers->count() > 0)
                    @foreach($recentUsers as $user)
                    <div class="flex items-center space-x-4 activity-item">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-primary">{{ $user->name }}</p>
                            <p class="text-xs text-secondary">{{ $user->email }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $user->role === 'admin' ? 'role-admin' : 
                                   ($user->role === 'organizer' ? 'role-organizer' : 
                                   ($user->role === 'company' ? 'role-company' :
                                   ($user->role === 'coach' ? 'role-coach' :
                                   ($user->role === 'player' ? 'role-player' :
                                   'role-default')))) }}">
                                {{ $user->getRoleDisplayName() }}
                            </span>
                            <p class="text-xs text-secondary mt-1">
                                {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-secondary">Nessuna attività recente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 