<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Admin Seeder */
        $admin = User::create([
            'type' => 'admin',
            'username' => 'admin',
            'name' => 'Admin Intellectus',
            'email' => 'admin@intellectus.dev',
            'password' => Hash::make('admin'),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        /* Client Seeder */
        $client = User::create([
            'type' => 'user',
            'username' => 'user',
            'name' => 'Usuário Intellectus',
            'email' => 'user@intellectus.dev',
            'password' => Hash::make('user'),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
    }
}
