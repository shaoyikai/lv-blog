<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    public function tags()
    {
        return $this->belongsTo('App\Posts','posts_id','id');
    }
}
