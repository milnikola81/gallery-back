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

    public static function addComment($request) {
        return Comment::create([
            'content' => $request->content,
            'gallery_id' => $request->gallery_id,
            'user_id' => $request->user_id,
        ])
        ->load('user');
    }
}
