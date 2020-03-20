<?php

namespace Modules\Restaurant\Actions;

use TCG\Voyager\Actions\AbstractAction;

class CreateSupply extends AbstractAction
{
    public function getTitle()
    {
        return 'Insumos';
    }

    public function getIcon()
    {
        return 'voyager-params';
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
        // return route('voyager.roles.index');
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'branch_offices';
    }

    public function massAction($ids, $comingFrom)
    {
        return redirect()->route('voyager.supplies.index');
    }
}