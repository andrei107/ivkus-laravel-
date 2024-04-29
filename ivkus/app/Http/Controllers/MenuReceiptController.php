<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\ReceiptModel;
use App\Models\MenuModel;
use Illuminate\Support\Facades\App;

class MenuReceiptController extends Controller
{
    public function index($menu_id)
    {
        $receiptsInCategory = ReceiptModel::getReceiptByMenu($menu_id);
        $blockName = MenuModel::getItemByMenuId($menu_id);

        return view('pages.receipt-by-menu', [
           'receiptsInCategory' => $receiptsInCategory,
           'menuItems'=> MenuModel::all(),
           'blockName' => $blockName,
           'lang' => App::getLocale()
        ]);
    }

}
