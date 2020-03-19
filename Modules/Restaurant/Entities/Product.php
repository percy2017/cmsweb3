<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Streaming\Entities\Category;
class Product extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = [];



    public function categoryId(){
        return $this->belongsTo(Category::class);
    }
}
