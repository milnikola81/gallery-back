<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'gallery_id', 'user_id'
    ];

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
