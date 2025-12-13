<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale');
        if (!$locale || !in_array($locale, ['ar','en'])) {
            $locale = config('app.locale');
            session(['locale' => $locale]);
        }
        app()->setLocale($locale);
        $dir = $locale === 'en' ? 'ltr' : 'rtl';
        if (!session()->has('dir') || !in_array(session('dir'), ['rtl','ltr'])) {
            session(['dir' => $dir]);
        }
        return $next($request);
    }
}
