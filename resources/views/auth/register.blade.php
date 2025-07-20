@extends('layouts.auth')

@section('title', __('Registrazione - Basketball Hub'))

@section('content')
<div class="max-w-md w-full space-y-8">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 bg-orange-500 rounded-lg flex items-center justify-center">
            <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 8a4 4 0 118 0 4 4 0 01-8 0z"/>
            </svg>
        </div>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">{{ __('Registrazione') }}</h2>
        <p class="mt-2 text-sm text-gray-600">{{ __('Crea il tuo account Basketball Hub') }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Nome') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Conferma Password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>

            <button type="submit" 
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                {{ __('Registrati') }}
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">{{ __('Hai già un account?') }} 
                <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-500 font-semibold">{{ __('Accedi') }}</a>
            </p>
        </div>
    </div>
</div>
@endsection 