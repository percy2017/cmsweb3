<?php

namespace Modules\Streaming\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use NumerosEnLetras;
class AccountController extends Controller
{
    public $table = 'sanes_accounts';
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

        $this->menu = Voyager::model('Menu')->where('name', '=', $this->dataType->name)->first();
        $this->menuItems = Voyager::model('MenuItem')->where('menu_id', '=', $this->menu->id)->orderBy('order', 'asc')->get();

        
    }

    public function index()
    {
        return view('streaming::bread.index', [
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
        //----------------VALIDATIONS-----------------------------------------
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:sanes_accounts',
        //     'email' => 'required|email|unique:sanes_accounts',
        //     'password' => 'required|unique:sanes_accounts',
        //     'renovation' => 'required'
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['error'=>$validator->errors()]);
        // }
        //----------------VALIDATIONS --------------------------------------
           


        // -------------------------CAJA ------------------------------------------------
        $model_box = Voyager::model('DataType')->where('slug', '=', 'sanes_boxes')->first();
        $box = $model_box->model_name::where('status', 1)->first();

        if ($box) {

            //------------------ REGISTRO-------------------------------------
            $data = new $this->dataType->model_name;
            foreach ($this->dataRowsAdd as $key) {
                $aux =  $key->field;
                switch ($key->type) {
                    case 'Traking':
                        $data->$aux = Auth::user()->id;
                        break;
                    case 'image':
                        if($request->hasFile($aux)){
                            $image=Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $request->file($aux));
                            $data->$aux = $image;
                        }
                        break;
                    case 'relationship':
                        
                        break;
                    case 'checkbox':
                        $data->$aux = $request->$aux ? 1 : 0;
                        break;  
                    default:
                        $data->$aux = $request->$aux;
                        break;
                }
            }
            $data->save();
            // --------------------------REGISTRO ---------------------------------------------------

            
            $model_seating = Voyager::model('DataType')->where('slug', '=', 'sanes_seatings')->first();
            $model_seating->model_name::create([
                'concept' => 'Pago por compra de la cuenta: '.$data->name,
                'amount' => $data->price,
                'type' => 'EGRESOS',
                'user_id' => Auth::user()->id,
                'box_id' => $box->id,
            ]);
            $balance = $box->balance - $data->price;
            $box->balance = $balance;
            $box->save();
        } else {
            return response()->json(['error'=>['message' => 'No tienes caja abierta']]);
        }
        //-----------------CAJA------------------------------------------------------------

        return $this->show();
    }

    public function show($id = null)
    {
        $dataTypeContent = $this->dataType->model_name::orderBy($this->dataType->details->{'order_column'}, $this->dataType->details->{'order_direction'})->paginate(setting('admin.pagination')); 
        return view('streaming::bread.show', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

    public function edit($id)
    {
        $data = $this->dataType->model_name::find($id);
        return view('streaming::bread.edit', [
            'dataType' => $this->dataType,
            'dataRows'=> $this->dataRowsEdit,
            'data' => $data
        ]); 
    }

    public function update(Request $request, $id)
    {
        //----------------VALIDATIONS-----------------------------------------
        // $validator = Validator::make($request->all(), [
        //     'attribute' => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['error'=>$validator->errors()]);
        // }
        //--------------------------------------------------------------------

        $data = $this->dataType->model_name::find($id);
        foreach ($this->dataRowsEdit as $key) {
            $aux =  $key->field;
            switch ($key->type) {
                case 'Traking':
                    $data->$aux = Auth::user()->id;
                    break;
                case 'image':
                    if($request->hasFile($aux)){
                        $image=Storage::disk('public')->put($this->dataType->name.'/'.date('F').date('Y'), $request->file($aux));
                        $data->$aux = $image;
                    }
                    break;
                case 'relationship':
                    
                    break;
                case 'checkbox':
                    $data->$aux = $request->$aux ? 1 : 0;
                    break;  
                default:
                    $data->$aux = $request->$aux;
                    break;
            }
        }
        $data->save();
        return $this->show();
    }

    public function destroy($id)
    {
        $data = $this->dataType->model_name::find($id)->delete();
        return $this->show();
    }
}
