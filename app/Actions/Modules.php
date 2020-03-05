<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Modules extends AbstractAction
{
    public function getTitle()
    {
        return 'Instalar Modulo';
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
        $disable=\App\Module::where('id', $this->data->{$this->data->getKeyName()})->first();
        if ( $disable->installed) {
            return [
                'class' => 'btn btn-default',
            ];
        } else {
            return [
                'class' => 'btn btn-primary',
            ];
        }
        
     
    }

    public function getDefaultRoute()
    {
        $disable=\App\Module::where('id', $this->data->{$this->data->getKeyName()})->first();
        if ( $disable->installed) {
            
        } else {
            return route('module_installer', $this->data->{$this->data->getKeyName()});
        }
        
        
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