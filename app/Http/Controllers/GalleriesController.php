<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Http\Requests\GalleryPostRequest;

class GalleriesController extends Controller
{
    public function store(GalleriesPostRequest $request)
    {
        return Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
    }

    public function index() {
        return Gallery::
        with('user')
        ->with('images')
        ->paginate(10);
    }

    public function show($id)
    {
        return Gallery::with('user')
        ->with('images')
        ->findOrFail($id);
    }
}

