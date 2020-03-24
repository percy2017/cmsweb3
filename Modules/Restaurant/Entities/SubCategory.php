<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'sub_categories';
    protected $fillable = ['name', 'description', 'slug', 'category_id'];
}
