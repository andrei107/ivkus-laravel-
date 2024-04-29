<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\MenuModel;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        return view('cms.menu');
    }

    public function load()
    {
        if( !MenuModel::all()) {
            return response()->json([
                'code' =>  401,
                'status' => 'error',
                'message' =>  'Ошибка загрузки!',
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'menu' => MenuModel::all()
            ]);
        }
    }

    public function add(MenuRequest $request)
    {
        $query = $request->all();
        $entity = new MenuModel();
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

    public function read(Request $request)
    {
        $entity = MenuModel::find($request->id);
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
        if (MenuModel::find($request->id)->delete()) {
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

    public function edit(MenuRequest $request )
    {
        $query = $request->all();
        $entity = MenuModel::find($request->id);
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
