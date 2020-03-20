<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class Map extends AbstractHandler
{
    protected $codename = 'Map';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.map', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}