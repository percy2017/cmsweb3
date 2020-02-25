<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Roles extends AbstractAction
{
    public function getTitle()
    {
        return 'Roles';
    }

    public function getIcon()
    {
        return 'voyager-lock';
    }

    public function getPolicy()
    {
        return 'browse_roles';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-primary',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.roles.index');
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }

    public function massAction($ids, $comingFrom)
    {
        return redirect()->route('voyager.roles.index');
    }
}