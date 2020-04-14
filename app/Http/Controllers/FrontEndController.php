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
use App\Events\Telematic\NewMessage;
use App\Events\Telematic\NewMessageTyping;

class FrontEndController extends Controller
{
    function
    default()
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
        // return $collection;
        $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
        // return $blocks;
        return view($collection->direction, [
            'collection' => json_decode($collection->details, true),
            'page' => $collection,
            'blocks'     => $blocks
        ]);
    }

    function videochats()
    {
        $userList = User::where('id', '<>', Auth::user()->id)->select('id', 'name', 'avatar')->get();
        return view('vendor.videochats.index', compact('userList'));
    }
    function videochats_request(Request $request)
    {
        $stream = $request->stream;
        $user_emisor = User::find($request->emisorId, ['id', 'name', 'avatar']);
        $user_receptor = User::find($request->receptId, ['id', 'name', 'avatar']);
        if ($request->type == 'request') {
            event(new RequestStreamUser($user_emisor, $user_receptor, $stream));
        } else {
            event(new ResponseStreamUser($user_emisor, $user_receptor, $stream));
        }
    }

    function videochats_message(Request $request){
        $data = [
            'user' => $request->user,
            'message' => $request->message,
            'date' => $request->date,
        ];
        event(new NewMessage($data));
    }

    function videochats_message_typing(Request $request){
        event(new NewMessageTyping($request->user));
    }
}
