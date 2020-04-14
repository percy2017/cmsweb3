<?php

namespace Modules\Inti\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntiStudent extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'inti_students';
    protected $fillable = ['phone','user_id','subscription_id'];
}
