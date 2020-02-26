<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class Tracking extends AbstractHandler
{
    protected $codename = 'Traking';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.traking', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}