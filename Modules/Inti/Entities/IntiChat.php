<?php

namespace Modules\Inti\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntiChat extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'inti_chats';
    protected $fillable = ['transmitter','receiver','type_message','message','live_id'];
}
