<?php

namespace Modules\CashFlow\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use Modules\CashFlow\Entities\Seating;
use NumerosEnLetras;
use Modules\CashFlow\Entities\Box;

class SeatingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($box_id)
    {
        $seating = Seating::where('box_id', $box_id)->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'seatings')->first();
        $ingresos = Seating::where('box_id', $box_id)->where('type', 'INGRESOS')->get();
        $egresos = Seating::where('box_id', $box_id)->where('type', 'EGRESOS')->get();

        $monto_total = Seating::where('box_id', $box_id)->sum('amount');

        $total_literal = NumerosEnLetras::convertir($monto_total, 'Bolivianos', true);

        $box=Box::where('id', $box_id)->first();
        //return $ingresos;
        return view('cashflow::seatings.index', [
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cashflow::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cashflow::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cashflow::edit');
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
    public function close($box_id){
        $close=Box::where('id', $box_id)->first();
        $close->status= false;
        $close->save();

        return redirect()->route('voyager.boxes.index')->with([
            'message'    =>  $close->title.' Cerrada Correctamente',
            'alert-type' => 'success',
        ]);
    }
}
