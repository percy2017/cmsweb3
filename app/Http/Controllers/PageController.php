<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class PageController extends Controller
{
    function default($page_id)
    {
        $page = Page::where('id', $page_id)->first(); 
        
        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => $page->slug]);

            return back()->with([
                'message'    => $page->name.' - plantilla establecida',
                'alert-type' => 'success',
            ]);
    }

    function edit($page_id)
    {
        $page = Page::where('id', $page_id)->first(); 
        $dataType = Voyager::model('DataType')->where('slug', '=', 'pages')->first();
        return view('vendor.pages.edit', [
            'page' => $page,
            'dataType' => $dataType
        ]);
    }
 
    public function update(Request $request, $page_id)
    {
        $page = Page::where('id', $page_id)->first();
        $mijson = $page->details;
        
        foreach(json_decode($page->details, true) as $item => $value)
        {
            if($value['type'] == 'image')
            {
              
                $mijson = str_replace($value['value'], $value['value'], $mijson);
            }else{
                if($value['type'] == 'space')
                {
                }else
                {
                    $mijson = str_replace($value['value'], $request[$value['name']], $mijson);
                }
                
            }
            if($request->hasFile($value['name']))
            {
                $dirimage = Storage::disk('public')->put('pages/'.date('F').date('Y'), $request->file($value['name']));
                $mijson = str_replace($value['value'], $dirimage, $mijson);
            }
           
        }
        $page->details = $mijson;
        // $page->position = $request->position;
        $page->save();
        
        return back()->with([
            'message'    => 'Pagina Actualizada - '.$page->name,
            'alert-type' => 'success',
        ]);
    }
}
