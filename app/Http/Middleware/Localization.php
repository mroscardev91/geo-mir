<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        
     public function handle(Request $request, Closure $next): Response
     {
         if (Session::has('locale')) {
             $locale = Session::get('locale');
             Log::debug("Session 'locale' is '$locale'");
             App::setLocale($locale);
         }
  
  
         return $next($request);
     }
  
 
}
