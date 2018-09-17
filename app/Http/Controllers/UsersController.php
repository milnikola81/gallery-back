<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UsersPostRequest;

class UsersController extends Controller
{
    //

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
