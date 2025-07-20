<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->cookie('locale') ?? session('locale') ?? config('app.locale');

        $availableLocales = config('app.available_locales', []);
        
        if (!array_key_exists($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }
}
