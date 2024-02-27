<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks to avoid constraint violations during truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            [
                'first_name' => 'Superadmin',
                'last_name' => 'User',
                'email' => 'admin@gmail.com',
                'is_active' => 1,
                'role' => 1,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'), // Use the Hash facade for hashing
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin2@gmail.com',
                'is_active' => 1,
                'role' => 2,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'), // Use the Hash facade for hashing
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
