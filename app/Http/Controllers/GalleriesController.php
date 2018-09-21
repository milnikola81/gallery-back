<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Image;
use App\Http\Requests\GalleriesFormRequest;

class GalleriesController extends Controller
{
    public function index(Request $request) {
        return Gallery::getGalleries($request);
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
        return Gallery::getAuthor($user_id, $request);
    }

    public function show($id)
    {
        return Gallery::showGallery($id);
    }

    public function destroy($id) {
        return Gallery::destroy($id);
    }

    public function update(GalleriesFormRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->images()->delete();
        $gallery->update($request->all());

        $images = $request->images;

        foreach($images as $image) {
            Image::create([
                'image_url' => $image,
                'gallery_id' => $gallery->id
            ]);
        }       
    }
}

