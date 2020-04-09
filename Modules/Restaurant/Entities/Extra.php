<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Extra extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'yimbo_extras';
}
