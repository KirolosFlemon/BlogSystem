<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'phone' => '01204825685',
        ], [
            'name' => 'Kirolous',
            'phone' => '01204825685',
            'email' => 'kirolous.felemon95@gmail.com',
            'image' => null,
            'password' => 123455678,

        ]);
    }
}
