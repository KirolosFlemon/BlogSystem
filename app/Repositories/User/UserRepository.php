<?php

// app/Repositories/UserRepository.php
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{

    /**
     * Finds a user by its ID.
     *
     * @param int $id The ID of the user to find.
     * @throws ModelNotFoundException if the user with the given ID is not found.
     * @return User The found user object.
     */
    public function find()
    {
        $id= auth()->user()->id;
    
        return User::findOrFail($id);
    }

}
