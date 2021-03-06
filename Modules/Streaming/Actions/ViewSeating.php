<?php

namespace Modules\Streaming\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ViewSeating extends AbstractAction
{
    public function getTitle()
    {
        return 'Ver Asientos';
    }

    public function getIcon()
    {
        return 'voyager-file-text';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right',
            'style'=>'margin:5px;'
        ];
    }

    public function getDefaultRoute()
    {
        return route('seating_index', $this->data->{$this->data->getKeyName()});
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'boxes';
    }
}