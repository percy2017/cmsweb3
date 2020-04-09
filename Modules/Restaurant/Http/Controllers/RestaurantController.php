<?php

namespace Modules\Restaurant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Validator;
use NumerosEnLetras;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('restaurant::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('restaurant::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('restaurant::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('restaurant::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function search(Request $request)
    {
        
        $dataTypeContent = DB::table($request->table)->where($request->search_type, 'like', '%'.$request->search_text.'%')->orderBy('id', 'desc')->paginate(setting('admin.pagination'));
         $dataType = Voyager::model('DataType')->where('slug', '=', $request->table)->first();
        return view('restaurant::bread.show', [
            'dataType' =>  $dataType,
            'dataTypeContent' => $dataTypeContent,
            'search_text' => $request->search_text,
            'search_type' => $request->search_type
        ]);
    }

    public function relationship($id, $table, $key, $type)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();

        switch ($type) {
            case 'list':
                 
                $dataTypeContent = $dataType->model_name::where($key, $id)->orderBy('id', 'asc')->paginate(setting('admin.pagination')); 
                return view('restaurant::bread.show', [
                    'dataType' =>  $dataType,
                    'dataTypeContent' => $dataTypeContent
                ]);
                break;
            case 'create':
                $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
                $dataRowsAdd = Voyager::model('DataRow')->where([['data_type_id', '=', $dataType->id], ['add', "=", 1]])->orderBy('order', 'asc')->get();
        
                return view('restaurant::bread.create', [
                    'dataType' => $dataType,
                    'dataRows'=>$dataRowsAdd,
                    'key' => $key,
                    'id' => $id
                ]);
                break;
            default:
                # code...
                break;
        }
        
    }

    public function view($table, $id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
        $dataRows = Voyager::model('DataRow')->where([['data_type_id', '=', $dataType->id], ['read', "=", 1]])->orderBy('order', 'asc')->get();
        
        $data = $dataType->model_name::where('id', '=', $id)->first();
    
        // return response()->json($dataRows);
        return view('restaurant::bread.view', [
            'dataType' =>  $dataType,
            'dataRows' => $dataRows,
            'data' => $data

        ]);
    }

    public function deletes($table)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
        $dataTypeContent = $dataType->model_name::onlyTrashed()->orderBy('deleted_at', 'asc')->paginate(setting('admin.pagination')); 
    
        // return response()->json($dataTypeContent);
        return view('restaurant::bread.deletes', [
            'dataType' =>  $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
        
        
    }

    public function recovery($table, $id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
        $dataType->model_name::withTrashed()->where('id', '=', $id)->restore();
        $dataTypeContent = $dataType->model_name::onlyTrashed()->orderBy('deleted_at', 'asc')->paginate(setting('admin.pagination')); 
    
        // return response()->json($dataTypeContent);
        return view('restaurant::bread.deletes', [
            'dataType' =>  $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
