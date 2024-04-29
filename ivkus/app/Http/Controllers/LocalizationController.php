<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Classes\Locale;


class LocalizationController extends Controller
{
    public function setLocale(Request $request, $locale)
    {
        $preparedLocale = Locale::prepareBeLocale($locale);

        Session::put('locale', $preparedLocale);
        App::setLocale($preparedLocale);

        return redirect(Locale::getLocaleUrl($locale));
    }
}
