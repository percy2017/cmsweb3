<?php

namespace Modules\Inti\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntiCareer extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'inti_careers';
    protected $fillable = ['title','slug','image','description'];
}
