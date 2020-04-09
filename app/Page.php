<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pages';
<<<<<<< HEAD
    protected $fillable = ['name', 'slug', 'details', 'description', 'user_id', 'image', 'direction'];
=======
    protected $fillable = ['name', 'slug', 'details', 'description', 'user_id', 'image','direction'];
>>>>>>> de4bc0a9c62e386927649c0c1e10b0422799a13e
}
