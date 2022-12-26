<?php

namespace Database\Seeders\Publication;

use App\Models\Publication\PublicationType;
use Illuminate\Database\Seeder;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PublicationType::create([
            'code' => 'text',
            'name' => 'Texto',
        ]);

        PublicationType::create([
            'code' => 'image',
            'name' => 'Imagem',
        ]);

        PublicationType::create([
            'code' => 'video',
            'name' => 'Vídeo',
        ]);

        PublicationType::create([
            'code' => 'survey',
            'name' => 'Enquete',
        ]);

        PublicationType::create([
            'code' => 'interest',
            'name' => 'Interesse',
        ]);
    }
}
