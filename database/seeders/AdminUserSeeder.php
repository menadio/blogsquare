<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => config('blogsquare.admin_name'),
            'email' => config('blogsquare.admin_email'),
        ], [
            'password' => Hash::make(config('blogsquare.admin_password')),
        ]);
    }
}
