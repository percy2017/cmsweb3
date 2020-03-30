<?php

namespace Modules\Streaming\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanesRenovationAccount extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['plane', 'description', 'account_id', 'user_id'];
    protected $table = 'sanes_renovation_accounts';
}
