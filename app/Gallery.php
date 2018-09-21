<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Gallery extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public static function getGalleries($request) {
        $searchTerm = $request->input('search', '');
        $query = Gallery::query();
        $query->with('user', 'images');
        $query->whereHas('user', function($query) use ($searchTerm) {
            $query->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('description', 'like', '%'.$searchTerm.'%')
                        ->orWhere('first_name', 'like', '%'.$searchTerm.'%')
                            ->orWhere('last_name', 'like', '%'.$searchTerm.'%');
        });
        $galleries = $query->orderBy('created_at', 'DESC')->paginate(10);
        return $galleries;
    }

    public static function getAuthor($user_id, $request) { 
        $searchTerm = $request->input('search', '');
        
        return Gallery::with('user')
        ->with('images')
        ->with('comments.user')
        ->where('user_id', $user_id)
        ->where('title', 'like', '%' . $searchTerm .'%')
        ->orwhere('user_id', $user_id)
        ->where('description', 'like', '%' . $searchTerm .'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
    }

    public static function showGallery($id)
    {
        return Gallery::with('user')
        ->with('images')
        ->with('comments.user')
        ->findOrFail($id);
    }

    public static function storeGallery($request)
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

    public static function updateGallery($request, $id)
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
