<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Block;
use App\Page;
use App\User;

// Events
use App\Events\Telematic\RequestStreamUser;
use App\Events\Telematic\ResponseStreamUser;

class FrontEndController extends Controller
{
    function default()
    {
        
        $page = setting('site.page');
        $collection = Page::where('slug', $page)->first();
       
        $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
        return view($collection->direction, [
            'collection' => json_decode($collection->details, true),
            'page' => $collection,
            'blocks'     => $blocks
        ]);
    }

    public function pages($slug)
    {
        $collection = Page::where('slug', $slug)->first();
        $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
        return view($collection->direction, [
            'collection' => json_decode($collection->details, true),
            'page' => $collection,
            'blocks'     => $blocks
        ]);
    }
    
    function videochats(){
        $userList = User::where('id', '!=', Auth::user()->id)->select('id', 'name', 'avatar')->get();
        return view('vendor.videochats.index', compact('userList'));
    }
    function videochats_request(Request $request){
        $tokken = $request->stream;
        $user_id_emisor = $request->emisorId;
        $user_id_receptor = $request->receptId;
        if($request->type == 'request'){
            event(new RequestStreamUser($user_id_emisor, $user_id_receptor, $tokken));
        }else{
            event(new ResponseStreamUser($user_id_emisor, $user_id_receptor, $tokken));
        }
    }
}
