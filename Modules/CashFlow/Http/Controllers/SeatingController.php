<?php

namespace Modules\CashFlow\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use TCG\Voyager\Facades\Voyager;
use Modules\CashFlow\Entities\Seating;
use NumerosEnLetras;

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
        $ingresos= Seating::where('box_id', $box_id)->where('type', 'INGRESOS')->get();
        $egresos= Seating::where('box_id', $box_id)->where('type', 'EGRESOS')->get();
        $monto_total=Seating::where('box_id', $box_id)->sum('amount');
        $total_literal = NumerosEnLetras::convertir($monto_total,'Bolivianos',true);
        //return $ingresos;
        return view('cashflow::seatings.index', [
            'seating'  => $seating,
            'dataType' => $dataType,
            'ingresos' => $ingresos,
            'egresos'  => $egresos,
            'monto_total'=>$monto_total,
            'monto_literal'=>$total_literal

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
        //
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
}
