<?php

namespace Modules\Streaming\Actions\Boxes;

use TCG\Voyager\Actions\AbstractAction;

class CreateBox extends AbstractAction
{
    public function getTitle()
    {
        return 'Crear';
    }

    public function getIcon()
    {
        return 'voyager-plus';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-primary',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.details.index');
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'boxes';
    }
    public function massAction($ids, $comingFrom)
    {
        // Do something with the IDs
        return redirect()->route('myboxes.create');
    }
}