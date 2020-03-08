<?php

namespace Modules\Streaming\Actions;

use TCG\Voyager\Actions\AbstractAction;

class HistoryProfiles extends AbstractAction
{
    public function getTitle()
    {
        return 'Historial';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-warning pull-right',
            'style'=>'margib:5px;'
        ];
    }

    public function getDefaultRoute()
    {
        return route('profile_history', $this->data->{$this->data->getKeyName()});
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'profiles';
    }
}