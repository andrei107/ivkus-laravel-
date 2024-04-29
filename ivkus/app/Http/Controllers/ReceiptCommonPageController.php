<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Models\ReceiptModel;
use App\Models\MenuModel;
use App\Models\FilterTypes;
use App\Models\FilterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReceiptCommonPageController extends Controller
{
    public function index()
    {    $allData = ReceiptModel::all();
        return view('pages.common-receipt-page', [
		   'current_query' => $current_query,
		   'total_pages' => ceil( $total_users / 6 ),
           'allReceipts' => $allData,
		   'total_receipts' => count($allData),
           'menuItems'=> MenuModel::all(),
           'lang' => App::getLocale(),
           'dataTypes' => FilterTypes::all(),
           'dataValues' =>  FilterValue::all()
        ]);
    }
	
	public function filter(Request $request){
        $req = $request->data;
        $limit = isset($_POST['per-page']) ? $_POST['per-page'] : 9;
        $offset = 0; 
        $current_page = 1;
        if(isset($_POST['page_number'])) {
            $current_page = (int)$_POST['page_number'];
            $offset = ($current_page * $limit) - $limit;
        }

        $receipts = ReceiptModel::all();
        if(!empty($req)) { 
            $filtered_receipts = array();
            foreach($receipts as $receipt) { 
                if(strpos($req, $receipt->name)) {
                    $filtered_receipts[] = $receipt;
                }
            }
            $receipts = $filtered_receipts;
        }
		$paged_receipts = '';

		if(is_array($receipts)){
			$paged_receipts = array_slice($receipts, $offset, $limit);
		} else {
			$paged_receipts = $receipts->slice($offset, $limit);
		}
}
