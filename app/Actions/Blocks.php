<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Blocks extends AbstractAction
{
    public function getTitle()
    {
        return 'Blocks';
    }

    public function getIcon()
    {
        // return 'voyager-lock';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-primary',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.roles.index');
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'pages';
    }

    public function massAction($ids, $comingFrom)
    {
        return redirect()->route('voyager.blocks.index');
    }
}