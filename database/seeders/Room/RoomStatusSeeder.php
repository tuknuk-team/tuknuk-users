<?php

namespace Database\Seeders\Room;

use App\Models\Room\RoomStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomStatus::create([
            'name' => 'Ativa',
            'code' => 'active'
        ]);

        RoomStatus::create([
            'name' => 'Aguardando lançamento',
            'code' => 'pending'
        ]);

        RoomStatus::create([
            'name' => 'Encerrada',
            'code' => 'closed'
        ]);
    }
}
