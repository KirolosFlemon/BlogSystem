<?php
namespace App\Services\Auth;

use App\Repositories\Auth\RegisterRepository;
use App\Traits\HelperFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    /**
     * The register repository instance.
     *
     * @var \App\Repositories\Auth\RegisterRepository
     */
    protected $registerRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Auth\RegisterRepository  $registerRepository
     * @return void
     */
    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * Creates a new user and returns the created user object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function createRegister(Request $request)
    {
        try {
            DB::beginTransaction();

            $user =  $this->registerRepository->create($request);
            // Commit the transaction if all operations are successful
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            // Roll back the transaction if any operation fails
            DB::rollback();
            throw new \Exception($th->getMessage());
        }
    }

   
}

