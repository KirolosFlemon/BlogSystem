<?php
// app/Services/LoginService.php
namespace App\Services\Auth;

use App\Repositories\Auth\LoginRepository;
use App\Traits\HelperFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginService
{
    protected $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }



    public function createLogin(Request $request)
    {
        try {
            DB::beginTransaction();

            $user =  $this->loginRepository->create($request);
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
