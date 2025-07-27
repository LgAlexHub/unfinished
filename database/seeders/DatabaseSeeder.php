<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::query()->where('email', '=', 'alexlegras@hotmail.com')->first()){
            User::create([
                'name' => 'aleki',
                'email' => 'alexlegras@hotmail.com',
                'password' => Hash::make('azerty'),
            ]);
        }

        $this->call([
            MemberSeeder::class
        ]);
    }
}
