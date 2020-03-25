<?php

namespace Modules\Streaming\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Illuminate\Support\Facades\Storage;

use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\History;
use Modules\Streaming\Entities\Membership;
use Modules\Streaming\Entities\Account;
class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
        $dataTypeContent = Profile::paginate(3);

        return view('streaming::profiles.index', compact(
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
     
        return view('streaming::profiles.create', [
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
          
        return $request;
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

    public function change($id){
        //return $request;
        $profile = Profile::find($id);
        $profile->status = false;
        $profile->save();

        History::create([
            'type'=>'Cuenta dada de baja',
            'profile_id'=>$id,
            'user_id'=>auth()->user()->id

        ]);
        return redirect()->route('profile_history', $id)->with([
            'message'    =>  $profile->fullname.' Actualizado Correctamente',
            'alert-type' => 'success',
        ]);
    

    }
}
