<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductExtra extends Model
{
    protected $table = 'yimbo_extra_product';
    protected $fillable = ['product_id', 'extra_id'];
}
