<?php

namespace Database\Seeders\User;

use App\Models\User\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserStatus::create([
            'name' => 'Ativo',
        ]);

        UserStatus::create([
            'name' => 'Temporariamente bloqueado',
            'message' => 'Sua conta foi temporariamente bloqueada, caso tenha alguma dúvida referente a este bloqueio entre em contato com nosso time de  suporte.'
        ]);

        UserStatus::create([
            'name' => 'Permanentemente bloqueado',
            'message' => 'Sua conta foi permanentemente bloqueada, caso tenha alguma dúvida referente a este bloqueio entre em contato com nosso time de  suporte.'
        ]);

    }
}
