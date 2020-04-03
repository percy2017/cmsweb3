<?php

namespace Modules\Inti\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntiCourse extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'inti_courses';
    protected $fillable = ['title','slug','body','inti_content_id'];
}
