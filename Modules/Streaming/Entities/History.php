<?php

namespace Modules\Streaming\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class History extends Model
{   
    use SoftDeletes;
    protected $table = 'histories';
    protected $fillable = ['type', 'profile_id', 'user_id'];
}
