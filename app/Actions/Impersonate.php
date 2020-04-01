<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Impersonate extends AbstractAction
{
    public function getTitle()
    {
        return 'Login';
    }

    public function getIcon()
    {
        return 'voyager-github';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-dark',
        ];
    }

    public function getDefaultRoute()
    {
        return route('impresionate', $this->data->{$this->data->getKeyName()});
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }

    // public function massAction($ids, $comingFrom)
    // {
    //     return redirect()->route('voyager.users.index');
    // }
}