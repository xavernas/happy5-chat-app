<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_available = [
            [
                'username' => 'Abdul',
                'email' => 'abdul@gmail.com',
                'password' => 'abdulganteng',
            ],
            [
                'username' => 'Baby',
                'email' => 'baby@gmail.com',
                'password' => 'babycantik',
            ],
            [
                'username' => 'Cici',
                'email' => 'cici@gmail.com',
                'password' => 'cicicantik',
            ],
            [
                'username' => 'Debul',
                'email' => 'debul@gmail.com',
                'password' => 'debulganteng',
            ]
        ];
        // DB::table('users')->insert($user_available);
        User::insert($user_available);
    }
}
