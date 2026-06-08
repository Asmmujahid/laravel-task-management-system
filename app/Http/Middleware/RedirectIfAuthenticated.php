<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'team_lead') {
                return redirect()->route('team_lead.dashboard');
            }

            if ($role === 'team_member') {
                return redirect()->route('team_member.dashboard');
            }
        }

        return $next($request);
    }
}

