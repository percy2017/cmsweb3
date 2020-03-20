<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $fillable = [
            'name',
            'address',
            'phone',
            'whatsapp',
            'longitud',
            'latitud',
            'user_id'  
    ];
}
