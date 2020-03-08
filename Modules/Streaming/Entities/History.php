<?php

namespace Modules\Streaming\Entities;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = ['type', 'profile_id', 'user_id'];
}
