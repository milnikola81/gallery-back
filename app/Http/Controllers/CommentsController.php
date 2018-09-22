<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentsFormRequest;

class CommentsController extends Controller
{
    public function store(CommentsFormRequest $request)
    {
        return Comment::addComment($request);
    }

    public function destroy($comment) 
    {
        return Comment::destroy($comment);
    }
}
