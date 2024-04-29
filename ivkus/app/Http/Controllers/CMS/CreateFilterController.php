<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\FilterValue;
use App\Models\CMS\FilterTypes;
use Illuminate\Http\Request;
use App\Http\Requests\FilterTypesRequest;
use App\Http\Requests\FilterValuesRequest;

class CreateFilterController extends Controller
{
    public function index()
    {
        return view('cms.create-filter', [
            'types' => FilterTypes::all(),
        ]);
    }

    public function load()
    {
        return response()->json([
            'status' => 'success',
            'types' => FilterTypes::all(),
            'values' => FilterValue::all()
        ]);
    }

    public function addType(FilterTypesRequest $request)
    {
        $query = $request->all();
        $entity = new FilterTypes();
        if($entity->fill($query)->save()) {
			$status = 'success';
		} else {
			$status = 'error';
		}

        return response()->json([
				'status' => $status
        ]);
    }

    public function addValue(FilterValuesRequest $request)
    {
        $query = $request->all();
        $entity = new FilterValue();
        if( !$entity->fill($query)->save() ) {
			return response()->json([
                'code'      =>  400,
                'message'   =>  'Ошибка сохранения!'
            ]);
        } else {
            return response()->json([
				'status' => 'success',
                'code' => 200,
                'message' => 'Успешно сохранено!'
            ]);
        }
    }


    public function deleteType(Request $request)
    {
        if (FilterTypes::find($request->id)->delete()) {
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

    public function deleteValue(Request $request)
    {
        if (FilterValue::find($request->id)->delete()) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'При удалении произошла ошибка'
            ]);
        }
    }


    public function readTypes(Request $request)
    {
        $entity = FilterTypes::find($request->id);
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

    public function readValues(Request $request)
    {
        $entity = FilterValue::find($request->id);
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

    public function editTypes(FilterTypesRequest $request )
    {
        $query = $request->all();
        $entity = FilterTypes::find($request->id);
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

    public function editValues(FilterValuesRequest $request )
    {
        $query = $request->all();
        $entity = FilterValue::find($request->id);
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
}
