<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Http\Requests\GalleryPostRequest;

class GalleryController extends Controller
{
    public function store(GalleriesPostRequest $request)
    {
        return Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
    }
}
