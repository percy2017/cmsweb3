<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'yimbo_categories';
    protected $fillable = ['name', 'slug', 'description', 'image'];
    
}
