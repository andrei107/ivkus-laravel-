<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\ReceiptModel;
use App\Models\MenuModel;
use Illuminate\Support\Facades\App;

class ReceiptPageController extends Controller
{
    public function index($id)
    {
        $receiptItem = ReceiptModel::getReceiptById($id);
        $menuItem = MenuModel::getItemByMenuId($receiptItem->for_menu);
        $relatedReceipts = ReceiptModel::getReceiptsByMenuId($receiptItem->for_menu, $id);

        return view('pages.receipt-page', [
           'receiptItem' => $receiptItem,
           'menuItems'=> MenuModel::all(),
           'menuItem' => $menuItem,
           'relatedReceipts' => $relatedReceipts,
           'lang' => App::getLocale()
        ]);
    }
}
