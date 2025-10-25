<?php

public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->check()) {
        // If the request came via AJAX or expects JSON (like your modal login)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'redirect' => route('dashboard')
            ]);
        }

        // Otherwise, normal browser redirect
        return redirect()->route('dashboard');
    }

    return $next($request);
}