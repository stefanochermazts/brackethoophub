<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        $availableLocales = config('app.available_locales', []);
        
        if (!array_key_exists($locale, $availableLocales)) {
            $locale = config('app.fallback_locale', 'en');
        }
        
        session()->put('locale', $locale);
        
        return redirect()->back()->withCookie(cookie('locale', $locale, 60 * 24 * 365));
    }
} 