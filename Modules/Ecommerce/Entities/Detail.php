<?php

namespace Modules\Ecommerce\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Detail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'details';
    protected $fillable = [];
}
