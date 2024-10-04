<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginRepository
{

    public function create(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user['token'] = auth('api')->login($user);

            return $user; // Return the authenticated user
        }


        throw new \Exception('Invalid credentials');
    }
}
