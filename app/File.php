<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shares()
    {
        return $this->belongsToMany('App\User', 'shares')->withPivot('deleted');
    }
}
