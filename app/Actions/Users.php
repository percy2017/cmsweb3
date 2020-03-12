<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Users extends AbstractAction
{
    public function getTitle()
    {
        return 'Usuarios';
    }

    public function getIcon()
    {
        return 'voyager-group';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-warning',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('voyager.roles.index');
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'roles';
    }

    public function massAction($ids, $comingFrom)
    {
        return redirect()->route('voyager.users.index');
    }
}