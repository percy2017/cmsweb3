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
use Modules\Restaurant\Entities\SubCategory;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'products')->first();
        $dataTypeContent = call_user_func([DB::table($dataType->name), 'paginate']);

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
 
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->get();
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
     
        // return $request;    
       

        $product = Product::create([
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

        $image_array = [];
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
        //
    }

    function ajaxdata($id)
    {
        $data = SubCategory::where('category_id', $id)->get();
        return $data;
    }
}
