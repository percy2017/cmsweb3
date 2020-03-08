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
class StreamingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('streaming::index');
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
        //
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
}
