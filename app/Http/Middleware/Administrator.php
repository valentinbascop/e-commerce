<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if (!Auth::guard('admin')->check()) {
        return redirect()->route('backend.login');
      }

      \App::setLocale('fr');
      setlocale(LC_ALL,  'fr_FR.UTF-8');
      Carbon::setLocale('fr');

      return $next($request);
    }
}