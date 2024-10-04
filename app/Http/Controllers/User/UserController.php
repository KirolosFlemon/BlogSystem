<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function get()
    {
        $useres = $this->userService->getUserById();
        return new UserResource($useres);
    }
 
}
