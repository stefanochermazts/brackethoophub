<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-primary">{{ __('admin.user_management') }}</h2>
            <p class="text-secondary">{{ __('admin.manage_user_accounts') }}</p>
        </div>
        <button wire:click="showCreateModal" class="btn-primary px-4 py-2 rounded-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>{{ __('admin.add_user') }}</span>
        </button>
    </div>

    <!-- Search and Filters -->
    <div class="stat-card p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input wire:model.live="search" type="text" placeholder="{{ __('admin.search_users') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <select wire:model.live="roleFilter" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">{{ __('admin.all_roles') }}</option>
                    @if(auth()->user()->isAdmin())
                        <option value="admin">{{ __('admin.administrators') }}</option>
                        <option value="organizer">{{ __('admin.organizers') }}</option>
                    @endif
                    <option value="company">{{ __('admin.companies') }}</option>
                    <option value="coach">{{ __('admin.coaches') }}</option>
                    <option value="player">{{ __('admin.players') }}</option>
                    @if(auth()->user()->isAdmin())
                        <option value="user">{{ __('admin.users') }}</option>
                    @endif
                </select>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="stat-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">
                            {{ __('admin.user') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">
                            {{ __('admin.role') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">
                            {{ __('admin.registration_date') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-secondary uppercase tracking-wider">
                            {{ __('admin.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-orange-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-primary">{{ $user->name }}</div>
                                    <div class="text-sm text-secondary">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $user->role === 'admin' ? 'role-admin' : 
                                   ($user->role === 'organizer' ? 'role-organizer' : 
                                   ($user->role === 'company' ? 'role-company' :
                                   ($user->role === 'coach' ? 'role-coach' :
                                   ($user->role === 'player' ? 'role-player' :
                                   'role-default')))) }}">
                                {{ $user->getRoleDisplayName() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button wire:click="edit({{ $user->id }})" class="text-orange-600 hover:text-orange-900 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                @if($user->id !== auth()->id())
                                <button wire:click="delete({{ $user->id }})" class="text-red-600 hover:text-red-900 transition-colors"
                                        onclick="return confirm('{{ __('admin.confirm_delete_user') }}')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-secondary">
                                <svg class="w-12 h-12 mx-auto mb-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                <p class="text-lg font-medium text-primary">{{ __('admin.no_users_found') }}</p>
                                <p class="text-secondary">{{ __('admin.try_adjusting_filters') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="px-6 py-4">
            {{ $users->links() }}
        </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white" wire:click.stop>
            <div class="stat-card rounded-2xl shadow-2xl overflow-hidden transform transition-all">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-primary">
                            {{ $editing ? __('admin.edit_user') : __('admin.create_user') }}
                        </h3>
                        <button wire:click="closeModal" class="text-secondary hover:text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-secondary">
                            {{ __('admin.name') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input id="name" wire:model="name" type="text" required
                                   class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   placeholder="{{ __('admin.enter_name') }}">
                        </div>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-secondary">
                            {{ __('admin.email') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email" wire:model="email" type="email" required
                                   class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   placeholder="{{ __('admin.enter_email') }}">
                        </div>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role Field -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-secondary">
                            {{ __('admin.role') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <select id="role" wire:model="role" required
                                    class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none">
                                <option value="">{{ __('admin.select_role') }}</option>
                                @php
                                    $availableRoles = auth()->user()->getAvailableRoles();
                                @endphp
                                @foreach($availableRoles as $roleKey => $roleLabel)
                                    <option value="{{ $roleKey }}">{{ $roleLabel }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    @if(!$editing)
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-secondary">
                            {{ __('admin.password') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" wire:model="password" type="password" required
                                   class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   placeholder="{{ __('admin.enter_password') }}">
                        </div>
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-secondary">
                            {{ __('admin.confirm_password') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input id="password_confirmation" wire:model="password_confirmation" type="password" required
                                   class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   placeholder="{{ __('admin.confirm_password') }}">
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 flex justify-end space-x-3">
                    <button wire:click="closeModal" type="button"
                            class="px-6 py-2.5 border rounded-xl text-sm font-medium text-secondary transition-colors">
                        {{ __('admin.cancel') }}
                    </button>
                    <button wire:click="save" type="button"
                            class="px-6 py-2.5 bg-orange-600 border border-transparent rounded-xl text-sm font-medium text-white hover:bg-orange-700 transition-colors">
                        {{ $editing ? __('admin.update') : __('admin.create') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div> 