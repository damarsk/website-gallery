<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'name'=>'AkunAdmin',
                'email'=>'admin@gmail.com',
                'email_verified_at'=>now(),
                'level'=>'admin',
                'password'=>Hash::make('123456'),
                'created_at'=>now(),
            ],
            
            [
                'name'=>'AkunUser1',
                'email'=>'user1@gmail.com',
                'email_verified_at'=>now(),
                'level'=>'user',
                'password'=>Hash::make('123456'),
                'created_at'=>now(),
            ],
            [
                'name'=>'AkunUser2',
                'email'=>'user2@gmail.com',
                'email_verified_at'=>now(),
                'level'=>'user',
                'password'=>Hash::make('123456'),
                'created_at'=>now(),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}