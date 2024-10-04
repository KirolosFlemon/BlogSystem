<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $registerService;

    public function __construct(LoginService $registerService)
    {
        $this->registerService = $registerService;
    }
    public function login(LoginRequest $request){

        $register = $this->registerService->createLogin($request);
        return new LoginResource($register);

    }

}
