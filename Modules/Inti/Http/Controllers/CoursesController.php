<?php

namespace Modules\Inti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use NumerosEnLetras;

class CoursesController extends Controller
{
    public $table = 'inti_courses';
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
        return view('inti::bread.index', [
            'dataType' =>  $this->dataType,
            'menuItems' => $this->menuItems
        ]);
    }

    public function create()
    {
        return view('inti::bread.create', [
            'dataType' => $this->dataType,
            'dataRows'=>$this->dataRowsAdd
        ]); 
    }

    public function store(Request $request)
    {
        // return $request;
        //----------------VALIDATIONS-----------------------------------------
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['error'=>$validator->errors()]);
        // }
        //----------------VALIDATIONS --------------------------------------
           
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
                case 'rich_text_box':
                    $data->$aux = htmlspecialchars($request->$aux);
                    break; 
                case 'Slug':
                    $myslug = $key->details->slugify->{'origin'};
                    $data->$aux = Str::slug($request->$myslug);
                    break; 
                default:
                    $data->$aux = $request->$aux;
                    break;
            }
        }
        $data->save();
        // --------------------------REGISTRO ---------------------------------------------------

        return $this->show();
    }

    public function show($id = null)
    {
        $dataTypeContent = $this->dataType->model_name::orderBy($this->dataType->details->{'order_column'}, $this->dataType->details->{'order_direction'})->paginate(setting('admin.pagination')); 
        return view('inti::bread.show', [
            'dataType' =>  $this->dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

    public function edit($id)
    {
        $data = $this->dataType->model_name::find($id);
        return view('inti::bread.edit', [
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
                case 'rich_text_box':
                    $data->$aux = htmlspecialchars($request->$aux);
                    break; 
                case 'Slug':
                    $myslug = $key->details->slugify->{'origin'};
                    $data->$aux = Str::slug($request->$myslug);
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
