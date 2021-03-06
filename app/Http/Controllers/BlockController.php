<?php

namespace App\Http\Controllers;
use App\Block;
use App\Page;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BlockController extends Controller
{
    function index($page_id)
    {
        $page = Page::where('id', $page_id)->first();
        $blocks = Block::where('page_id', $page_id)->orderBy('position', 'asc')->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'blocks')->first();
        return view('vendor.pages.blocks', [
            'blocks' => $blocks,
            'dataType' =>  $dataType,
            'page' => $page
        ]);
    }

    public function update(Request $request, $block_id)
    {
        $block = Block::where('id', $block_id)->first();
        $mijson = $block->details;
        foreach(json_decode($block->details, true) as $item => $value)
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
                $dirimage = Storage::disk('public')->put('blocks/'.date('F').date('Y'), $request->file($value['name']));
                $mijson = str_replace($value['value'], $dirimage, $mijson);
            }
        }
        $block->details = $mijson;
       // $block->position = $request->position;
        $block->save();
        
        return back()->with([
            'message'    => 'Block Actualizada - '.$block->title,
            'alert-type' => 'success',
        ]);
    }
    public function delete($block_id)
    {
        Block::where('id', $block_id)->delete();
        return back()->with([
            'message'    => 'Block eliminado',
            'alert-type' => 'success',
        ]);
    }

    public function move_up($id)
    {
        $block = Block::where('id', $id)->first();
        $swapOrder = $block->position;

        $previousSetting = Block::where('position', '<', $swapOrder)->orderBy('position', 'DESC')->first();
        $data = [
        'message'    => __('voyager::settings.already_at_top'),
        'alert-type' => 'error',
        ];
        // return $previousSetting;
        if (isset($previousSetting->position)) {
            $block->position = $previousSetting->position;
            $block->save();
            $previousSetting->position = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('voyager::settings.moved_order_up', ['name' => $block->title]),
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }


    public function move_down($id)
    {
     
        $block = Block::where('id', $id)->first();

        $swapOrder = $block->position;

        $previousSetting = Block::where('position', '>', $swapOrder)->orderBy('position', 'ASC')->first();
        $data = [
            'message'    => __('voyager::settings.already_at_bottom'),
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->position)) {
            $block->position = $previousSetting->position;
            $block->save();
            $previousSetting->position = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('voyager::settings.moved_order_down', ['name' => $block->title]),
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }
}
