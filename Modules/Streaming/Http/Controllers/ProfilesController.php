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

use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\History;
use Modules\Streaming\Entities\Membership;
use Modules\Streaming\Entities\Account;
class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
 
      
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
     
        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }
       
        $isModelTranslatable = is_bread_translatable($dataTypeContent);
        
        return view('streaming::profiles.create', [
            'dataType' => $dataType,
            'dataTypeContent'=>$dataTypeContent,
            'isModelTranslatable'=>$isModelTranslatable
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
}
