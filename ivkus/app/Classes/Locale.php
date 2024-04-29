<?php

namespace App\Classes;
use Illuminate\Support\Facades\URL;

class Locale
{
    const LANG_RU = 'ru';
    const LANG_EN = 'en';
    const COUNTRY_CODES = [
        self::LANG_RU => 'RU',
        self::LANG_EN => 'US',
    ];

    public static function get()
    {
        return app()->getLocale() ? app()->getLocale() : self::LANG_RU;
    }

    public static function getPreparedLocales($locales = [])
    {
        $preparedLocales = [];
        $locales = empty($locales) ? self::getLocales() : $locales;

        foreach ($locales as $locale) {
            $preparedLocales[] = $locale !== self::LANG_RU ? $locale : self::LANG_RU;
        }

        return $preparedLocales;
    }

    public static function getLocales()
    {
        $configLocales = config('app.locales');
        $constants = (new \ReflectionClass(self::class))->getConstants();

        if (empty($configLocales)) {
            $filtered = array_filter(
                $constants,
                function ($val, $key) {
                    return strpos($key, 'LANG_') === 0;
                },
                ARRAY_FILTER_USE_BOTH
            );

            $locales = array_values($filtered);
        } else {
            $locales = $configLocales;
        }

        return $locales;
    }

    public static function prepareBeLocale($locale)
    {
        return $locale !== self::LANG_RU ? $locale : self::LANG_RU;
    }

    public static function getLocaleUrl($locale)
    {
        $preparedLocales = Locale::getPreparedLocales();
        $parsedPreviousUrl = parse_url(URL::previous());
        $preparedPrevUrl = !empty($parsedPreviousUrl['path']) ? $parsedPreviousUrl['path'] : '/ivkus';
        $previousUrlParts = explode('/', $preparedPrevUrl);

        if ($locale !== config('app.fallback_locale')) {
            if (in_array($previousUrlParts[1], $preparedLocales)) {
                $previousUrlParts[1] = $locale;
            } else {
                array_splice($previousUrlParts, 1, 0, $locale);
            }
        } elseif (in_array($previousUrlParts[1], $preparedLocales)) {
            unset($previousUrlParts[1]);
        }

        return implode('/', $previousUrlParts);
    }
}
