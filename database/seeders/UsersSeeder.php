<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    public function run(): void
    {
        $users = [
            [
                'name' => 'Jack',
                'email' => 'jack@mail.com',
                'password' => Hash::make('1234'),
                'role_id' => 1,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Susan',
                'email' => 'susan@mail.com',
                'password' => Hash::make('1234'),
                'role_id' => 2,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Bo',
                'email' => 'bo@mail.com',
                'password' => Hash::make('1234'),
                'role_id' => 2,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
        ];
    }
}
