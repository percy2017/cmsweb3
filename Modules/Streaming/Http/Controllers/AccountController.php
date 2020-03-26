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
use Illuminate\Support\Facades\Storage;

use Modules\Streaming\Entities\Account;
use Modules\Streaming\Entities\Box;
use Modules\Streaming\Entities\Seating;
use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\Membership;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use BreadRelationshipParser;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        $dataType = Voyager::model('DataType')->where('slug', '=', 'accounts')->first();
        $dataTypeContent = call_user_func([DB::table($dataType->name), 'paginate']);
        // $dataTypeContent = Voyager::model($dataType->name)->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();

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
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();
     
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
        $validatedData = $request->validate([
            'name' => ['unique:accounts'],
            'email' => ['unique:accounts'],
            'password' => ['unique:accounts']
        ]);

        // return $request;
        $box= Box::where('status', 1)->first();
  
        if (!isset($box)) {
            return redirect()->back()->with([
                'message'    =>  'El sistema detecto que no tiene una caja Abierta ',
                'alert-type' => 'error',
            ]);
        }else{

            //save accounts------------------------
            $account = Account::create([
                'type' => $request->type,
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' =>  $request->password,
                'price' =>  $request->price,
                'renovation' => date('Y-m-d H:i:s', strtotime($request->renovation)),
                'quantity_profiles' => $request->quantity_profiles,
                'description' =>  $request->description,
                'user_id' =>  Auth::user()->id
            ]);

 
            if($request->hasFile('image'))
            {
                $image=Storage::disk('public')->put('accounts/'.date('F').date('Y'), $request->file('image'));
 
                $account->image = $image;
                $account->save();
            }  

            //save seatings ------------------------------
            $asiento = Seating::create([
                'concept' => 'Pago por compra de un cuenta de, '.$request->type.' - '.$request->name,
                'amount' => $request->price,
                'type' => 'EGRESOS',
                'box_id' => $box->id,
                'user_id' => Auth::user()->id
            ]);

            $box->balance = $box->balance - $request->price;
            $box->save();     
        

            return redirect()->route('myaccounts.index')->with([
                'message'    =>  $request->name . ' Registrado',
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

    function ajax_profiles($account_id){
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
        $dataTypeContent = DB::table('profiles')->where('account_id', $account_id)->get();
        $account  = Account::where('id', $account_id)->first();
        return view('streaming::accounts.ajax.profiles', compact(
            'dataType',
            'dataTypeContent',
            'account'
        ));
    }

    function ajax_profiles_create($account_id){
        $dataType = Voyager::model('DataType')->where('slug', '=', 'profiles')->first();
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();

        return view('streaming::accounts.ajax.profiles_create', compact(
            'dataRows', 
            'dataType',
            'account_id'
        ));
    }
    function ajax_profiles_store(Request $request, $account_id){
        // return $request;
        $box= Box::where('status', 1)->first();
  
        if (!isset($box)) {
            return response()->json(['error' => 'caja cerrada']);
        }else{

            //save accounts------------------------
            $profile = Profile::create([
                'account_id' => $request->account_id,
                'membership_id' =>  $request->membership_id,
                'fullname' =>  $request->fullname,
                'phone' =>  $request->phone,
                'startdate' =>  date('Y-m-d H:i:s', strtotime($request->startdate)),
                'observation' => $request->observation,
                'user_id' =>  Auth::user()->id
            ]);

 
            if($request->hasFile('avatar'))
            {
                $image=Storage::disk('public')->put('profiles/'.date('F').date('Y'), $request->file('avatar'));
 
                $profile->avatar = $image;
                $profile->save();
            }  

            //save seatings ------------------------------
            $membreship= Membership::where('id', $request->membership_id)->first();
            $asiento = Seating::create([
                'concept' => 'Ingreso por venta de perfil: '.$membreship->title.' a '.$request->fullname,
                'amount' => $membreship->price,
                'type' => 'INGRESOS',
                'box_id' => $box->id,
                'user_id' => Auth::user()->id
            ]);
            
            $box->balance = $box->balance + $membreship->price;
            $box->save();     
        

            return $this->ajax_profiles($account_id);
        }
    }

}
