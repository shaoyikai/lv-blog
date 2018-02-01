<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    public function posts()
    {
        return $this->belongsTo('App\Posts','posts_id','id');
    }
}
