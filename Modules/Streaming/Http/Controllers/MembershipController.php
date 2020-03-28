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
    public $table = 'memberships';
    public $dataType;
    public $dataRowsAdd;
    public $dataRowsEdit;

    public $menu;
    public $menuItems;
    public function __construct()
    {
        $this->middleware('auth');
        $this->dataType = Voyager::model('DataType')->where('slug', '=', $this->table)->first();
        $this->dataRowsAdd = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['add', "=", 1]])->orderBy('order', 'asc')->get();
        $this->dataRowsEdit = Voyager::model('DataRow')->where([['data_type_id', '=', $this->dataType->id], ['edit', "=", 1]])->orderBy('order', 'asc')->get();

        $this->menu = DB::table('menus')->where('name', $this->dataType->name)->first();
        $this->menuItems = DB::table('menu_items')->where('menu_id', $this->menu->id)->get();
    }

    public function index()
    {
        // return dd($this->dataType->details);
        return view('streaming::bread.index',[
            'dataType' =>  $this->dataType,
            'menuItems' => $this->menuItems
        ]);
    }

    public function create()
    {
        
        return view('streaming::bread.create', [
            'dataType' => $this->dataType,
            'dataRows'=>$this->dataRowsAdd
        ]); 
        
    }

    public function store(Request $request)
    {
        //------------------------------------------------------------------
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|unique:memberships',
            'price' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        //-------------------------------------------------------------------

        $data = new Membership;
        foreach ($this->dataRowsAdd as $key) {
            $aux =  $key->field;
            
            if ($aux == 'user_id') {
                $data->$aux = Auth::user()->id;
            }else{
                $data->$aux = $request->$aux;
            }
        }
        $data->save();
        return $this->show();
    }

    public function show($id = null)
    {
        
        $dataTypeContent = Membership::orderBy($this->dataType->details->{'order_column'}, $this->dataType->details->{'order_direction'})->paginate(setting('admin.pagination')); 
        return view('streaming::bread.show', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

    public function edit($id)
    {
        $data = Membership::find($id);
        return view('streaming::bread.edit', [
            'dataType' => $this->dataType,
            'dataRows'=> $this->dataRowsEdit,
            'data' => $data
        ]); 
    }

    public function update(Request $request, $id)
    {
        //------------------------------------------------------------------
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        //------------------------------------------------------------------

        $data = Membership::find($id);
        // return $id;
        foreach ($this->dataRowsEdit as $key) {
            $aux =  $key->field;
            if ($aux == 'user_id') {
                $data->$aux = Auth::user()->id;
            }else{
                $data->$aux = $request->$aux;
            }
        }
        $data->save();
        return $this->show();
    }

    public function destroy($id)
    {
        $data = Membership::find($id)->delete();
        return $this->show();
    }

    public function search(Request $request)
    {
        // return $request->search_type;
        $dataTypeContent = Membership::where($request->search_type, 'like', '%'.$request->search_text.'%')->orderBy('id', 'desc')->paginate(setting('admin.pagination')); 
        return view('streaming::bread.show', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent,
            'search_text' => $request->search_text,
            'search_type' => $request->search_type
        ]);
    }
    
}
