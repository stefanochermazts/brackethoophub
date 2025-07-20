@extends('layouts.app')

@section('title', __('Login - Basketball Hub'))

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Accedi') }}</h1>
            <p class="text-gray-600">{{ __('Accedi al tuo account Basketball Hub') }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">{{ __('Ricordami') }}</label>
                    </div>
                    <a href="#" class="text-sm text-orange-600 hover:text-orange-500">{{ __('Password dimenticata?') }}</a>
                </div>
                <button type="submit" 
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                    {{ __('Accedi') }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">{{ __('Non hai un account?') }} 
                    <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-500 font-semibold">{{ __('Registrati') }}</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection 