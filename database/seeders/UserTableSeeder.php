<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=[
            'name'=>'Admin',
            'email'=>'nectardigit@gmail.com',
            'password'=>bcrypt('password'),
            'status'=>'1'
        ];
        User::create($user);
    }
}
