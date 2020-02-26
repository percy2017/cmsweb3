<?php

namespace Modules\Streaming\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'memberships';
    protected $fillable = [];
}
