<?php

namespace Modules\Ecommerce\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Details extends AbstractAction
{
    public function getTitle()
    {
        return 'Detalles';
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
            'class' => 'btn btn-sm btn-default pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('details_index', $this->data->{$this->data->getKeyName()});
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'products';
    }
}