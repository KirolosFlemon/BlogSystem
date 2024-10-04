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

    /**
     * The constructor for the controller.
     *
     * @param RegisterService $registerService The service class for the register controller.
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    /**
     * Handles the registration of a new user and returns the user object.
     *
     * @param RegisterRequest $request
     * @return RegisterResource
     */
    public function register(RegisterRequest $request)
    {
        $register = $this->registerService->createRegister($request);
        return new RegisterResource($register);
    }
}
