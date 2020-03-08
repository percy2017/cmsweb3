<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
use App\Module;
class Modules extends AbstractAction
{

    public function getTitle()
    {
        $mymodule = Module::where('id', $this->data->{$this->data->getKeyName()})->first();
        if ($mymodule->installed) {
            return 'Modulo Instaldo';
        } else {
            return 'Instalar Modulo';
        }
        
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
        $mymodule = Module::where('id', $this->data->{$this->data->getKeyName()})->first();
        if ( $mymodule->installed) {
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
        $mymodule = Module::where('id', $this->data->{$this->data->getKeyName()})->first();
        if ($mymodule->installed) {
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