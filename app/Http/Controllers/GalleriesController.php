<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Image;
use App\Http\Requests\GalleriesFormRequest;

class GalleriesController extends Controller
{
    public function index(Request $request) {
        $searchTerm = $request->input('search', '');
        return Gallery::with('user')
        ->with('images')
        ->with('comments')
        ->where('title', 'like', '%' . $searchTerm .'%')
        ->orWhere('description', 'like', '%' . $searchTerm .'%')
        // ->orWhere('first_name', 'like', '%' . $searchTerm .'%')
        // ->orWhere('last_name', 'like', '%' . $searchTerm .'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
    }

    public function store(GalleriesFormRequest $request)
    {
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        $images = $request->images;

        foreach($images as $image) {
            Image::create([
                'image_url' => $image,
                'gallery_id' => $gallery->id
            ]);
        }
    }

    public function showAuthor($user_id, Request $request)
    {
        $searchTerm = $request->input('search', '');
        return Gallery::with('user')
        ->with('images')
        ->with('comments.user')
        ->where('user_id', $user_id)
        ->where('title', 'like', '%' . $searchTerm .'%')
        ->orwhere('user_id', $user_id)
        ->where('description', 'like', '%' . $searchTerm .'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(1);
    }

    public function show($id)
    {
        return Gallery::with('user')
        ->with('images')
        ->with('comments.user')
        ->findOrFail($id);
    }

    public function destroy($id) {
        return Gallery::destroy($id);
    }


}

