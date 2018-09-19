<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Http\Requests\GalleryPostRequest;

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
    
    public function store(GalleriesPostRequest $request)
    {
        return Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
    }

    public function show($id)
    {
        return Gallery::with('user')
        ->with('images')
        ->findOrFail($id);
    }
}

