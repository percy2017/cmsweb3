<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Supply extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'yimbo_supplies';
}
