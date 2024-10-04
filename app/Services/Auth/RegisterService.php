<?php
// app/Services/RegisterService.php
namespace App\Services\Auth;

use App\Repositories\Auth\RegisterRepository;
use App\Traits\HelperFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }


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
