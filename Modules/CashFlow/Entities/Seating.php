<?php

namespace Modules\CashFlow\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seating extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'seatings';
    protected $fillable = [];
    
}
