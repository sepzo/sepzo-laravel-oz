<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run()
    {
        $numberOfUsers = 124;

        // User::factory($numberOfUsers)->create()->each(function ($user) { 
        //     $user->profile()->create([
        //         'bio' => 'Change this bio for user!! ' . $user->id, 
        //     ]);
        // });
    }
}