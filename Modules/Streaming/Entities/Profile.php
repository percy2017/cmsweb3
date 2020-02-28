<?php

namespace Modules\Streaming\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['fullname','phone','statu','finaldate','startdate','membership_id','observation','account_id'];
    protected $table = 'profiles';

    public function account() {

        return $this->belongsTo('Modules\Streaming\Entities\Account');

    }
    public function membership() {

        return $this->belongsTo('Modules\Streaming\Entities\Membership');

    }

    
}
