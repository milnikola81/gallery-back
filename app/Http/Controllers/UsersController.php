<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gallery;
use App\Http\Requests\UsersFormRequest;

class UsersController extends Controller
{

    public function store(UsersFormRequest $request)
    {
        return User::addUser($request);
    }

}
