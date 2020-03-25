<?php

namespace Modules\Restaurant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Modules\Restaurant\Entities\Product;
use Modules\Restaurant\Entities\Category;
use Modules\Restaurant\Entities\SubCategory;
class ProductController extends Controller
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'products')->first();
        $dataTypeContent = Product::paginate(6);

        return view('restaurant::products.index', compact(
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'products')->first();
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();
        return view('restaurant::products.create', [
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
            'name' => ['unique:products']
        ]);

        // return $request;    
        $product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'price_sale' => $request->price_sale,
            'price_minimum' => $request->price_minimum,
            'Last_Price_Buy' => $request->Last_Price_Buy,
            'stock' => $request->stock,
            'stock_minimum' => $request->stock_minimum,
            'description_long' => $request->description_long,
            'description_small' => $request->description_small,
            'slug' => Str::slug($request->name),
            'user_id' => Auth::user()->id,
        ]);

        $image_array = array();
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $array = Storage::disk('public')->put('products/'.date('F').date('Y'), $image);
                array_push($image_array, $array);
                
            }
            $product->images = $image_array;
           $product->save();
        }  
        
        //ingresando insumos ----------------------------------------------
        if (isset($request->product_belongstomany_supply_relationship)) {

            foreach ($request->product_belongstomany_supply_relationship as $key) {
                # code...
                DB::table('product_supply')->insert([
                    'product_id' => $product->id,
                    'supply_id' => $key
                ]);
            }
        }

        //ingresando extras --------------------------------------------------
        if (isset($request->product_belongstomany_extras_relationship)) {
            # code...
            // return $request;
            foreach ($request->product_belongstomany_extras_relationship as $key) {
                # code...
                DB::table('extra_product')->insert([
                    'product_id' => $product->id,
                    'extra_id' => $key
                ]);
            }
        }
        
        //devolviendo datos --------------------------------------------------
         return redirect()->route('myproducts.index')->with([
            'message'    =>  $request->name . ' Registrado',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('restaurant::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('restaurant::products.edit');
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
        $product = Product::find($id);
        $product->deleted_at = \Carbon\Carbon::now();
        $product->save();
        return back()->with([
            'message'    =>  $product->name .' Eliminado',
            'alert-type' => 'danger',
        ]);
    }

    function ajax_index($id, $model)
    {
        switch ($model) {
            case 'SubCategory':
                $data = SubCategory::where('category_id', $id)->get();
                return $data;
                break;
            
            default:
                # code...
                break;
        }
    }

    function ajax_create($table)
    {   
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();
        return view('restaurant::products.views.ajax_create', compact(
            'dataType',
            'dataRows'
        ));
    }

    function ajax_store(Request $request, $model)
    {
        switch ($model) {
            case 'Category':
                Category::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $request->image,
                    'description' => $request->description
                ]);
                return back()->with([
                    'message'    => $request->name.' registrado.',
                    'alert-type' => 'success',
                ]);
                
                break;
            
            default:
                # code...
                break;
        }
    }
    
    function ajax_destroy($id, $model)
    {
        switch ($model) {
            case 'products':
                $product = Product::find($id);
                $product->deleted_at = \Carbon\Carbon::now();
                $product->save();
                return $product;
                break;
            
            default:
                # code...
                break;
        }
     
    }
    function ajax_first($id, $model)
    {

        switch ($model) {
            case 'products':
                $data = Product::find($id);
                return view('restaurant::products.views.images', compact('data'));
                break;
            
            default:
                # code...
                break;
        }
                
    }
}
