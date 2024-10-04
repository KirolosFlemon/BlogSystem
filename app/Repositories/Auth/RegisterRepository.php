<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterRepository
{

    /**
     * Creates a new user and returns the created user object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        $user = User::create($request->all());
        return $user;
    }
}
