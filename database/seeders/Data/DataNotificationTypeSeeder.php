<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataNotificationType;
use Illuminate\Database\Seeder;

class DataNotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataNotificationType::create([
            'code' => 'comments',
            'name' => 'Comentários'
        ]);

        DataNotificationType::create([
            'code' => 'tags',
            'name' => 'Marcações'
        ]);

        DataNotificationType::create([
            'code' => 'new_followers',
            'name' => 'Atualização de quem segue você'
        ]);

        DataNotificationType::create([
            'code' => 'rooms',
            'name' => 'Salas'
        ]);

        DataNotificationType::create([
            'code' => 'follow_request',
            'name' => 'Solicitações para seguir'
        ]);
    }
}
