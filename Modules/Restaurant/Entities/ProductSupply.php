<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSupply extends Model
{
    protected $table = 'yimbo_product_supply';
    protected $fillable = ['product_id', 'supply_id'];
}
