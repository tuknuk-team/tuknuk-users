<?php

namespace Database\Seeders\Publication;

use App\Models\Publication\PublicationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PublicationStatus::create([
            'code' => 'published',
            'name' => 'Publicado',
        ]);

        PublicationStatus::create([
            'code' => 'removed_by_admin',
            'name' => 'Removido pelo Administrador',
        ]);

        PublicationStatus::create([
            'code' => 'removed',
            'name' => 'Removido pelo Usuário',
        ]);

        PublicationStatus::create([
            'code' => 'archived',
            'name' => 'Arquivado',
        ]);
    }
}
