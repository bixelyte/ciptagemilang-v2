<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (!in_array($locale, ['id', 'en'])) {
            $locale = $request->session()->get('locale', config('app.locale'));
        }

        if (in_array($locale, ['id', 'en'])) {
            app()->setLocale($locale);
            $request->session()->put('locale', $locale);
        }

        return $next($request);
    }
}
