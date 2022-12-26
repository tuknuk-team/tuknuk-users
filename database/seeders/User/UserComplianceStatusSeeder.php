<?php

namespace Database\Seeders\User;

use App\Models\User\UserComplianceStatus;
use Illuminate\Database\Seeder;

class UserComplianceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserComplianceStatus::create([
            'name' => 'Não Enviado',
        ]);

        UserComplianceStatus::create([
            'name' => 'Processando',
        ]);

        UserComplianceStatus::create([
            'name' => 'Negado',
        ]);

        UserComplianceStatus::create([
            'name' => 'Reenviado',
        ]);

        UserComplianceStatus::create([
            'name' => 'Aprovado',
        ]);
    }
}
