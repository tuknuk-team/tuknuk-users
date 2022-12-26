<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataNotificationChannel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataNotificationChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataNotificationChannel::create([
            'code' => 'push',
            'name' => 'Push'
        ]);

        DataNotificationChannel::create([
            'code' => 'email',
            'name' => 'E-mail'
        ]);

        DataNotificationChannel::create([
            'code' => 'sms',
            'name' => 'SMS'
        ]);
    }
}
