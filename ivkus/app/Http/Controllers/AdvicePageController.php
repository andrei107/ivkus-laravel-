<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\AdviceModel;
use Illuminate\Support\Facades\App;

class AdvicePageController extends Controller
{
    public function index($id)
    {
        $adviceItem = AdviceModel::getAdviceById($id);

        return view('pages.advice-page', [
           'adviceItem' => $adviceItem[0],
           'lang' => App::getLocale()
        ]);
    }
}
