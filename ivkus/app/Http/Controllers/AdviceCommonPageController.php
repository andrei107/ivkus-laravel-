<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\AdviceModel;
use Illuminate\Support\Facades\App;

class AdviceCommonPageController extends Controller
{
    public function index()
    {
        return view('pages.all-advice-page', [
           'allAdvice' => AdviceModel::all(),
           'lang' => App::getLocale()
        ]);
    }

}
