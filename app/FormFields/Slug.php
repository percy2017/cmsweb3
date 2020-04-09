<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class Slug extends AbstractHandler
{
    protected $codename = 'Slug';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.slug', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}