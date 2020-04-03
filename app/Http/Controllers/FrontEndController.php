<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Page;

class FrontEndController extends Controller
{
    function default()
    {
        
        $page = setting('site.page');
        $collection = Page::where('slug', $page)->first();
        $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
        return view($collection->direction, [
            'collection' => json_decode($collection->details, true),
            'blocks'     => $blocks
        ]);
    }

    function videochats()
    {
        return view('vendor.videochats.index');
    }
    function videochats_send($message)
    {
        event(new \App\Events\NewMessage($message));
        return $message;
        // return view('vendor.videochats.index');
    }
}
