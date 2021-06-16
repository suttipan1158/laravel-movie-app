<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'name' => 'User01',
                'email' => 'User01@user.com',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'User02',
                'email' => 'User02@user.com',
                'password' => bcrypt('1234')
            ]
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
