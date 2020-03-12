<?php

namespace Modules\Streaming\Http\Controllers;

use Exception;
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

use Modules\Streaming\Entities\Account;
use Modules\Streaming\Entities\Box;
use Modules\Streaming\Entities\Seating;
class AccountController extends Controller
{
    use BreadRelationshipParser;
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'accounts')->first();
        
        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        return view('streaming::accounts.create', [
            'dataType'=>$dataType,
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
        $box= Box::where('status', 1)->first();
  
        if (!isset($box)) {
            return redirect()->back()->with([
                'message'    =>  'El sistema detecto que no tiene una caja Abierta ',
                'alert-type' => 'error',
            ]);
        }else{
        //return $request;
        $account = Account::create([
            'type' => $request->type,
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' =>  $request->password,
            'price' =>  $request->price,
            'renovation' => date('Y-m-d H:i:s', strtotime($request->renovation)),
            'quantity_profiles' =>  $request->quantity_profiles,
            'description' =>  $request->description,
            'user_id' =>  $request->user_id
        ]);
        
        
        
        $asiento = Seating::create([
            'concept' => 'Pago por compra de Cuenta de, '.$request->type,
            'amount' => $request->price,
            'type' => 'EGRESOS',
            'box_id' => $box->id,
            'user_id' =>  $request->user_id
        ]);

        $box->balance = $box->balance - $request->price;
        $box->save();     

        return redirect()->route('voyager.accounts.index')->with([
            'message'    =>  $request->type . ' Registrado',
            'alert-type' => 'success',
        ]);
     }

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
}
