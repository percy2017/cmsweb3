<?php

namespace Modules\Streaming\Actions;

use TCG\Voyager\Actions\AbstractAction;

class AllAccount2 extends AbstractAction
{
    public function getTitle()
    {
        return 'Cuentas';
    }

    public function getIcon()
    {
         return 'voyager-credit-cards';
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
        return $this->dataType->slug == 'profiles';
    }
    public function massAction($ids, $comingFrom)
{
    // Do something with the IDs
    return redirect()->route('voyager.accounts.index');
}
}