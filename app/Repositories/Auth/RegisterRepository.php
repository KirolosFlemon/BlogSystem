<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterRepository
{
 
    public function create(Request $request)
    {
        $user= User::create($request->all());
        return $user;

    }


}
