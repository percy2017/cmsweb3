<?php

namespace Modules\Streaming\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use Illuminate\Support\Facades\Auth;

use Modules\Streaming\Entities\Box;
use Modules\Streaming\Entities\Seating;

use App\User;

use NumerosEnLetras;
class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'boxes')->first();
        $dataTypeContent = call_user_func([DB::table($dataType->name), 'paginate']);

        return view('streaming::boxes.index', compact(
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'boxes')->first();
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
     
        return view('streaming::boxes.create', [
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
        //
        
        $box = Box::create([
         'title'        =>  $request->title,
         'start_amount' =>  $request->start_amount,
         'balance'      =>  $request->balance,
         'status'       =>  $request->status ? 1 : 0,
         'user_id'      =>  auth()->user()->id
        ]);

        
        return redirect()->route('voyager.boxes.index')->with([
            'message'    =>  $box->title.' creada Correctamente',
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
        return view('streaming::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('streaming::edit');
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

    function seatings($box_id)
    {
        $seating = Seating::where('box_id', $box_id)->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'seatings')->first();
        $ingresos = Seating::where('box_id', $box_id)->where('type', 'INGRESOS')->get();
        $egresos = Seating::where('box_id', $box_id)->where('type', 'EGRESOS')->get();

        $monto_total = Seating::where('box_id', $box_id)->sum('amount');

        $total_literal = NumerosEnLetras::convertir($monto_total, 'Bolivianos', true);

        $box=Box::where('id', $box_id)->first();

        return view('streaming::boxes.seatings', [
            'seating'  => $seating,
            'dataType' => $dataType,
            'ingresos' => $ingresos,
            'egresos'  => $egresos,
            'monto_total' => $monto_total,
            'total_literal' => $total_literal,
            'box_id' => $box_id,
            'box'=>$box
        ]);
    }

    function contabilizar(Request $request)
    {
        Seating::create([
            'concept'   => $request->concept,
            'amount'    => $request->amount,
            'type'      => $request->type,
            'box_id'    => $request->box_id,
            'user_id'   => auth()->user()->id

        ]);

        $box = Box::where('id', $request->box_id)->first();

        if ($request->type == 'INGRESOS') {
            $box->balance = $box->balance + $request->amount;
        } elseif ($request->type == 'EGRESOS') {

            $box->balance = $box->balance - $request->amount;
        }
        $box->save();

        return back()->with([
            'message'    =>  $request->type . ' Registrado',
            'alert-type' => 'success',
        ]);
    }
}
