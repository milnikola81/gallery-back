<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gallery;
use App\Http\Requests\UsersPostRequest;

class UsersController extends Controller
{
        
    public function show($id, Request $request)
    {
        $searchTerm = $request->input('search', '');
        return Gallery::with('user')
        ->with('images')
        ->where('user_id', $id)
        ->where('title', 'like', '%' . $searchTerm .'%')
        ->orWhere('user_id', $id)
        ->where('description', 'like', '%' . $searchTerm .'%')
        ->paginate(1);
    }

    public function store(UsersPostRequest $request)
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'terms_accepted' => $request->terms_accepted,
            'remember_token' => str_random(10)
        ]);
    }

}
