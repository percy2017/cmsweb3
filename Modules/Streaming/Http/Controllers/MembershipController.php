<?php

namespace Modules\Streaming\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;

use Modules\Streaming\Entities\Box;
use Modules\Streaming\Entities\Seating;
use Modules\Streaming\Entities\Membership;
use Validator;
class MembershipController extends Controller
{
    public $dataType;
    public function __construct()
    {
        $this->middleware('auth');
        $this->dataType = Voyager::model('DataType')->where('slug', '=', 'memberships')->first();
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    function list(){
        // return 'hola';
        // $dataTypeContent = DB::table('memberships')->orderBy('id', 'desc')->paginate(setting('admin.paginacion')); 
        $dataTypeContent = Membership::orderBy('id', 'desc')->paginate(setting('admin.pagination')); 
        return view('streaming::memberships.list', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
    public function index()
    {
        return view('streaming::memberships.index',[
            'dataType' =>  $this->dataType
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dataRows = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['add', "=", 1]])->orderBy('order', 'asc')->get();
        return view('streaming::memberships.create', [
            'dataType' => $this->dataType,
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|unique:memberships',
            'price' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }

        $dataRows = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['add', "=", 1]])->get();
        $data = new Membership;
        foreach ($dataRows as $key) {
            $aux =  $key->field;
            
            if ($aux == 'user_id') {
                $data->$aux = Auth::user()->id;
            }else{
                $data->$aux = $request->$aux;
            }
        }
        $data->save();
        return $this->list();
    }

    /**
     * Show the specified resource999
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
        $dataRows = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['edit', "=", 1]])->orderBy('order', 'asc')->get();
        $data = Membership::find($id);
        return view('streaming::memberships.edit', [
            'dataType' => $this->dataType,
            'dataRows'=> $dataRows,
            'data' => $data
        ]); 
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }

        $dataRows = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['edit', "=", 1]])->get();
        $data = Membership::find($id);
        // return $id;
        foreach ($dataRows as $key) {
            $aux =  $key->field;
            if ($aux == 'user_id') {
                $data->$aux = Auth::user()->id;
            }else{
                $data->$aux = $request->$aux;
            }
        }
        $data->save();
        return $this->list();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = Membership::find($id)->delete();
        return $this->list();
    }

}
