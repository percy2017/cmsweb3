<?php

namespace Modules\Streaming\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'sanes_accounts';
    protected $fillable = ['type', 'name', 'email', 'password', 'price', 'renovation', 'quantity_profiles', 'description', 'user_id', 'image'];
}
