<?php

namespace Modules\Streaming\Actions\Profiles;

use TCG\Voyager\Actions\AbstractAction;

class Bread extends AbstractAction
{
    public function getTitle()
    {
        return 'Bread';
    }

    public function getIcon()
    {
         return 'glyphicon glyphicon-share-alt';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-md btn-dark',
            'target' => '_blank'
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
        return redirect()->route('voyager.bread.edit', 'profiles');
    }
}