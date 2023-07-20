<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
                ['name'=>'Admin User',
                'email'=>'admin@gmail.com',
                'role'=>1,
                'password'=> bcrypt('12345678'),
                ],
                [
                'name'=>'Admin User',
                'email'=>'admin2@gmail.com',
                'role'=>2,
                'password'=> bcrypt('12345678'),
                ]
                ];
        foreach($users as $value){
            User::create($value);
        }
    }
}
