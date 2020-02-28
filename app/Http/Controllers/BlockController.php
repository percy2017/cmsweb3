<?php

namespace App\Http\Controllers;
use App\Block;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    function index($page_id)
    {
        $blocks = Block::where('page_id', $page_id)->orderBy('position', 'asc')->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'blocks')->first();
        return view('vendor.pages.blocks', [
            'blocks' => $blocks,
            'dataType' =>  $dataType
        ]);
    }
}
