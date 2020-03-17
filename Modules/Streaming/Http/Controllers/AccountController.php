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
use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\Membership;
class AccountController extends Controller
{
    use BreadRelationshipParser;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        $dataType = Voyager::model('DataType')->where('slug', '=', 'accounts')->first();
        $dataTypeContent = call_user_func([DB::table($dataType->name), 'paginate']);

        return view('streaming::accounts.index', compact(
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'accounts')->first();
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
     
        return view('streaming::accounts.create', [
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
        // return $request;
        $box= Box::where('status', 1)->first();
  
        if (!isset($box)) {
            return redirect()->back()->with([
                'message'    =>  'El sistema detecto que no tiene una caja Abierta ',
                'alert-type' => 'error',
            ]);
        }else{

        $account = Account::create([
            'type' => $request->type,
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' =>  $request->password,
            'price' =>  $request->price,
            'renovation' => date('Y-m-d H:i:s', strtotime($request->renovation)),
            'quantity_profiles' => $request->quantity_profiles,
            'description' =>  $request->description,
            'status' =>  $request->status ? 1 : 0,
            'user_id' =>  Auth::user()->id
        ]);
        
        $asiento = Seating::create([
            'concept' => 'Pago por compra de un cuenta de, '.$request->type.' - '.$request->name,
            'amount' => $request->price,
            'type' => 'EGRESOS',
            'box_id' => $box->id,
            'user_id' => Auth::user()->id
        ]);

        $box->balance = $box->balance - $request->price;
        $box->save();     
        
        event(new \App\Events\NewMessage($asiento->concept));

        return redirect()->route('myaccounts.index')->with([
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

    function profiles($account_id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
        $account = Account::where('id', $account_id)->first();
        $profiles = Profile::where('account_id', $account_id)->get();
        $memberships = Membership::all();
        return view('streaming::accounts.profiles', [
            'dataType' => $dataType,
            'account'=>$account,
            'profiles'=>$profiles,
            'memberships'=>$memberships
        ]); 
    }

    function profiles_save(Request $request)
    {
        // return $request;

        $box= Box::where('status', 1)->first();
        $account= Account::where('id',  $request->account_id)->first();
        $profile=Profile::where('account_id', $request->account_id)->count();
        //return $profile;
        if (!isset($box)) {
            return redirect()->back()->with([
                'message'    =>  'El sistema detecto que no tiene una caja Abierta ',
                'alert-type' => 'error',
            ]);
            }else{
            if(!($profile < $account->quantity_profiles)){
                return redirect()->back()->with([
                    'message'    =>  'El limite perfiles'.$profile ,
                    'alert-type' => 'error',
                ]);

            }else {
                Profile::create([
                'account_id' =>  $request->account_id,
                'membership_id' =>  $request->membership_id,
                'fullname' =>  $request->fullname,
                'phone' =>  $request->phone,
                'status' =>  1,
                'finaldate'=> date('Y-m-d H:i:s', strtotime($request->finaldate)),
                'observation' =>  $request->observation,
                'user_id' => Auth::user()->id
                ]);

                $membership = Membership::where('id', $request->membership_id)->first();
                $asiento = Seating::create([
                    'concept' => 'Ingreso  por venta del Perfil, '.$request->fullname,
                    'amount' => $membership->price,
                    'type' => 'INGRESOS',
                    'box_id' => $box->id,
                    'user_id' => Auth::user()->id
                ]);

                $box->balance = $box->balance - $request->price;
                $box->save();  

                event(new \App\Events\NewMessage($asiento->concept));
                return redirect()->back()->with([
                    'message'    => 'Perfil registrado correctamente',
                    'alert-type' => 'success',
                ]);
            }  
        }
    }

}
