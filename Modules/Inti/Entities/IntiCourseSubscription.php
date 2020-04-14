<?php

namespace Modules\Inti\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntiCourseSubscription extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'inti_course_subscriptions';
    protected $fillable = ['course_id','subscription_id'];
}
