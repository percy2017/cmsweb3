<?php

namespace Modules\Streaming\Actions\Accounts;

use TCG\Voyager\Actions\AbstractAction;

class AllProfile extends AbstractAction
{
    public function getTitle()
    {
        return 'Perfiles';
    }

    public function getIcon()
    {
        return 'fa fa-users';
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
        return $this->dataType->slug == 'accounts';
    }
    public function massAction($ids, $comingFrom)
{
    // Do something with the IDs
    return redirect()->route('voyager.profiles.index');
}
}