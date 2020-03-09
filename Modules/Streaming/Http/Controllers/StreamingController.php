<?php

namespace Modules\Streaming\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use TCG\Voyager\Facades\Voyager;
use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\History;
use Modules\Streaming\Entities\Membership;
use Modules\Streaming\Entities\Account;

use Modules\Streaming\Entities\Seating;
use Modules\Streaming\Entities\Box;
use NumerosEnLetras;
class StreamingController extends Controller
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
        return view('streaming::seatings.index', [
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
        return view('streaming::create');
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
        
        $profile = Profile::findOrFail($id);
        $profile->membership_id = $request->membership_id;
        $profile->finaldate = $request->finaldate;      
        $profile->save();
        History::create([
            'type'=>'Renovacion',
            'profile_id'=>$id,
            'user_id'=>auth()->user()->id

        ]);
        return redirect()->route('profile_history', $id)->with([
            'message'    =>  $profile->fullname.' Actualizado Correctamente',
            'alert-type' => 'success',
        ]);
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

    public function history($id){
        
        $profiles   = Profile::find($id);
        $dataType   = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
        $histories  = History::where('profile_id', $id)->get();
        $membresias = Membership::all();
        $accounts   = Account::all();
        
        return view('streaming::profiles.show', [
            'dataType'   =>  $dataType,
            'profiles'   =>  $profiles,
            'histories'  =>  $histories,
            'membresias' =>  $membresias,
            'accounts' => $accounts
        ]);
    }

    public function change(Request $request){
        //return $request;
        $profile = Profile::find($request->profile_id);
        $profile->account_id = $request->account_id;
        $profile->save();

        History::create([
            'type'=>'Cambio de Cuenta',
            'profile_id'=>$request->profile_id,
            'user_id'=>auth()->user()->id

        ]);
        return redirect()->route('profile_history', $request->profile_id)->with([
            'message'    =>  $profile->fullname.' Actualizado Correctamente',
            'alert-type' => 'success',
        ]);
    

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
