<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BranchOffice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'yimbo_branch_offices';
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
