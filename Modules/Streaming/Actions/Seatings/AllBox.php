<?php

namespace Modules\Streaming\Actions\Seatings;

use TCG\Voyager\Actions\AbstractAction;

class AllBox extends AbstractAction
{
    public function getTitle()
    {
        return 'Cajas';
    }

    public function getIcon()
    {
        return 'voyager-list';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-warning',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.details.index');
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'seatings';
    }
    public function massAction($ids, $comingFrom)
    {
        // Do something with the IDs
        return redirect()->route('voyager.boxes.index');
    }
}