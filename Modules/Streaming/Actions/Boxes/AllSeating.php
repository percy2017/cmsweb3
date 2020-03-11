<?php

namespace Modules\Streaming\Actions\Boxes;

use TCG\Voyager\Actions\AbstractAction;

class AllSeating extends AbstractAction
{
    public function getTitle()
    {
        return 'Asientos';
    }

    public function getIcon()
    {
        return 'voyager-company';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-success',
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
        return redirect()->route('voyager.seatings.index');
    }
}