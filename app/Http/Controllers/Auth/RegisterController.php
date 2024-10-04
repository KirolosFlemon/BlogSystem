<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    public function register(RegisterRequest $request)
    {
        return   $register = $this->registerService->createRegister($request);
        return new RegisterResource($register);
    }
}
