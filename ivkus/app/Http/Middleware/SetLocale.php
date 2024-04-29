<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use \App\Classes\Locale;

class SetLocale
{

    public function handle($request, Closure $next)
    {
        $locale = Locale::prepareBeLocale($request->segment(1));

        if($locale) {
            $locale = in_array($locale, Locale::getLocales()) ? $locale : Locale::LANG_RU;
            Session::put('locale', $locale);
        } else {
            $locale = Session::get('locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}