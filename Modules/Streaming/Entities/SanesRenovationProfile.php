<?php

namespace Modules\Streaming\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanesRenovationProfile extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['membership_id', 'description', 'account_id', 'user_id'];
    protected $table = 'sanes_renovation_profiles';
}
