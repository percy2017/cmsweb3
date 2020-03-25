<?php

namespace Modules\Streaming\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at','finaldate'];
    protected $fillable = ['fullname','avatar','phone','image','finaldate','startdate','membership_id','observation','account_id', 'user_id'];
    protected $table = 'profiles';

    // public function account() {

    //     return $this->belongsTo('Modules\Streaming\Entities\Account');

    // }
    // public function membership() {

    //     return $this->belongsTo('Modules\Streaming\Entities\Membership');

    // }

    // public function history() {

    //     return $this->belongsTo('Modules\Streaming\Entities\History');

    // }

    
}
