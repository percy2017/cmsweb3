<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
use App\Module;
class ModuleView extends AbstractAction
{

    public function getTitle()
    {

        return 'Detalles';

        
    }

    public function getIcon()
    {
        // return 'voyager-lock';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {

        return [
            'class' => 'btn btn-success',
        ];


    }

    public function getDefaultRoute()
    {

        return route('module_view', $this->data->{$this->data->getKeyName()});

    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'modules';
    }

    // public function massAction($ids, $comingFrom)
    // {
    //     return redirect()->route('voyager.modules.index');
    // }
    
}