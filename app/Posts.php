<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    public function users()
    {
        return $this->belongsTo('App\User','users_id','id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    public function tags()
    {
        return $this->hasMany('App\Tags');
    }
}
