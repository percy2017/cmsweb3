<?php

namespace Modules\Rokola\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Track extends Model
{ 
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'accounts';
    protected $fillable = ['name', 'direction', 'image'];
}
