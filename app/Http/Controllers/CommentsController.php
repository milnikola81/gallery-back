<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentsFormRequest;

class CommentsController extends Controller
{
    public function store(CommentsFormRequest $request)
    {
        return Comment::create([
            'content' => $request->content,
            'gallery_id' => $request->gallery_id,
            'user_id' => $request->user_id,
        ])
        ->load('user');
    }

    public function destroy($comment) {
        return Comment::destroy($comment);
    }
}
