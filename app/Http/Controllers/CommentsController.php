<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentsPostRequest;

class CommentsController extends Controller
{
    public function store(CommentsPostRequest $request)
    {
        return Comment::create([
            'content' => $request->content,
            'gallery_id' => $request->gallery_id,
            'user_id' => $request->user_id,
        ]);
    }
}
