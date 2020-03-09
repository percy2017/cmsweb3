<?php

namespace Modules\Streaming\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'boxes';
    protected $fillable = ['title','start_amount','balance','status','user_id'];
}
