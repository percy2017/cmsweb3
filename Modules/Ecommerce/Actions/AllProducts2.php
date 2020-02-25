<?php

namespace Modules\Ecommerce\Actions;

use TCG\Voyager\Actions\AbstractAction;

class AllProducts2 extends AbstractAction
{
    public function getTitle()
    {
        return 'Productos';
    }

    public function getIcon()
    {
        // return 'voyager-pen';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.details.index');
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'categories';
    }
    public function massAction($ids, $comingFrom)
{
    // Do something with the IDs
    return redirect()->route('voyager.products.index');
}
}