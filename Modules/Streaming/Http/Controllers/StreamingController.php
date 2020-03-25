<?php

namespace Modules\Streaming\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;

use Modules\Streaming\Entities\Profile;
use Modules\Streaming\Entities\History;
use Modules\Streaming\Entities\Membership;
use Modules\Streaming\Entities\Account;
use Modules\Streaming\Entities\Seating;
use Modules\Streaming\Entities\Box;

use NumerosEnLetras;
class StreamingController extends Controller
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
        return view('streaming::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        
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

    function ajax_index($table, $key, $search)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'accounts')->first();
        $dataTypeContent = DB::table('profiles')->where($key, $search)->get();
        return view('streaming::ajax.index', compact(
            'dataType',
            'dataTypeContent'
        ));
    }

    function ajax_create($table)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $table)->first();
        $dataRows = Voyager::model('DataRow')->where('data_type_id', '=', $dataType->id)->orderBy('order', 'asc')->get();
      
        return view('streaming::ajax.create', compact(
            'dataType',
            'dataRows'
        ));
    }
}
