<?php

namespace Modules\Restaurant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;
use Modules\Restaurant\Entities\BranchOffice as EntitiesBranchOffice;
use TCG\Voyager\Facades\Voyager;
use Modules\Restaurant\Entities\BranchOffice;
class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'branch_offices')->first();
        $dataTypeContent = call_user_func([DB::table($dataType->name), 'paginate']);

        return view('restaurant::Branch_offices.index', compact(
            'dataType',
            'dataTypeContent'
        ));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'branch_offices')->first();
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
        
        return view('restaurant::Branch_offices.create', [
            'dataType' => $dataType,
            'dataRows'=>$dataRows
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        BranchOffice::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'whatsapp'=>$request->whatsapp,
            'latitud'=>$request->latitud,
            'longitud'=>$request->longitud
            
        ]);
        return redirect()->route('mybranch_offices.index')->with([
            'message'    =>  'Sucursal agregada correctamente ',
            'alert-type' => 'success',
        ]);

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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'branch_offices')->first();
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
        $branchoffice=BranchOffice::find($id);
        return view('restaurant::Branch_offices.edit', [
            'dataType' => $dataType,
            'dataRows'=>$dataRows,
            'branchoffice'=>$branchoffice
        ]);
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
}
