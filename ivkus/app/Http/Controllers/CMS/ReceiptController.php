<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\ReceiptModel;
use App\Models\CMS\MenuModel;
use Illuminate\Http\Request;
use App\Http\Requests\ReceiptRequest;
use App\Services\PhpExcelService;
use CreateReceiptController;

class ReceiptController extends Controller
{
    public function index()
    {
        $menu = MenuModel::getMenu();
        $allReceipts = ReceiptModel::all();

        return view('cms.receipt', [
            'data' => ReceiptModel::all(),
            'menu' => $menu
        ]);
    }

    public function load()
    {
        $menu = MenuModel::getMenu();
        $allReceipts = ReceiptModel::all();

        if( !$allReceipts ) {
            return response()->json([
                'code' =>  401,
                'status' => 'error',
                'message' =>  'Ошибка загрузки!',
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'allReceipts' => $allReceipts,
                'menu' => $menu
            ]);
        }
    }

    public function add(Request $request)
    {
        $file = $request->file('img');
       // dd($file);
        $completeFileName = $file->getClientOriginalName();
        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file->storeAs("docs/".$completeFileName, $completeFileName);

        $query = $request->all();
        $query['img'] = $completeFileName;
        $entity = new ReceiptModel();
       
        if( !$entity->fill($query)->save() ) {
			return response()->json([
                'code'      =>  400,
                'message'   =>  'Ошибка сохранения!'
            ]);
        } else {
            event(new CreateReceiptController($query));
            return response()->json([
				'status' => 'success',
                'code' => 200,
                'message' => 'Успешно сохранено!'
            ]);
        }
    }

    public function read(Request $request)
    {
        $entity = ReceiptModel::find($request->id);
        if ( !$entity ) {
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => 'Ошибка чтения из базы'
            ]);
        } else {
            return response()->json([
                'data' => $entity,
                'status' => 'success',
            ]);
        }
    }

    public function delete(Request $request)
    {
        if (ReceiptModel::find($request->id)->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Успешно удалено!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Произошла ошибка удаления'
            ]);
        }
    }

    public function edit(ReceiptRequest $request )
    {
        $query = $request->all();
        $entity = ReceiptModel::find($request->id);

        $file = $request->file('img');
        $completeFileName = $file->getClientOriginalName();
        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file->storeAs("docs/".$completeFileName, $completeFileName);

        if( !$entity->update($query) ) {
			return response()->json([
                'code'      =>  400,
                'message'   =>  'Ошибка сохранения!'
            ]);
        }

        return response()->json([
				'status' => 'success',
                'code' => 200,
                'message' => 'Успешно сохранено!'
        ]);
    }

    public function getDocument(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $active_sheet = $objPHPExcel->getActiveSheet();
        $active_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $active_sheet->getPageSetup()->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $active_sheet->getPageMargins()->setTop(1);
        $active_sheet->getPageMargins()->setRight(0.75);
        $active_sheet->getPageMargins()->setLeft(0.75);
        $active_sheet->getPageMargins()->setBottom(1);
  
        $active_sheet->setTitle("Список юзеров");

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(8);

        $active_sheet->getColumnDimension('A')->setWidth(7);
        $active_sheet->getColumnDimension('B')->setWidth(80);
        $active_sheet->getColumnDimension('C')->setWidth(10);
        $active_sheet->getColumnDimension('D')->setWidth(10);

        $active_sheet->setCellValue('A1','№');
        $active_sheet->setCellValue('B1','Имя');
        $active_sheet->setCellValue('C1','role');
        $active_sheet->setCellValue('D1','salary');

        $row_start = 2;
        $data = TestDataModel::all();

        $i = 0;
		foreach($data as $item) {
			$row_next = $row_start + $i;
			$active_sheet->setCellValue('A'.$row_next, (string) $item->id);
			$active_sheet->setCellValue('B'.$row_next,(string) $item->name_ru);
			$active_sheet->setCellValue('C'.$row_next,(string) $item->role);
			$active_sheet->setCellValue('D'.$row_next,(string) $item->salary);
			$i++;
		}

		header("Content-Disposition: attachment; filename=file.xlsx");
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('php://output');
    }
}
