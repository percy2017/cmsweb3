<?php

namespace Modules\CashFlow\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ViewSeating extends AbstractAction
{
    public function getTitle()
    {
        return 'Ver Asientos';
    }

    public function getIcon()
    {
        return 'fa fa-book';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right',
            'style'=>'margin: 5px',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.seatings.index', 'key=box_id&filter=equals&s='.$this->data->{$this->data->getKeyName()});
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'boxes';
    }
}