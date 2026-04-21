<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if(getLanguages()->count()) {

            session('dir') ?? session()->put('dir', getLanguages('default')->dir);
            session('code') ?? session()->put('code', getLanguages('default')->code);

            app()->setLocale(session('code') ?? 'ar');

        } else {

            app()->setLocale(app()->getLocale());
            
        }//en dof check

        app()->setLocale('ar');
        session()->put('code', 'ar');
        session()->put('dir', 'RTL');

        return $next($request);

    }//end of handle

}//end of class