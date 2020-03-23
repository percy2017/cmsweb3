<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = ['sub_category_id', 'name', 'price_sale', 'price_minimum', 'Last_Price_Buy', 'stock', 'stock_minimum', 'description_small', 'description_long', 'slug', 'user_id', 'images', 'category_id'];

}
