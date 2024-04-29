<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\ReceiptModel;
use App\Models\AdviceModel;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    public function index()
    {
        return view('main.index', [
            'bestReceipts'=> ReceiptModel::getReceiptByTypeBlock('best'),
            'dayReceipt'=> ReceiptModel::getReceiptByTypeBlock('day'),
            'fastReceipts'=> ReceiptModel::getReceiptByTypeBlock('fast'),
            'advice' => AdviceModel::all(),
            'lang' => App::getLocale()
        ]);
    }
}
