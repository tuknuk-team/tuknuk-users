<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataPrivacyTypeOption;
use Illuminate\Database\Seeder;

class DataPrivacyTypeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataPrivacyTypeOption::create([
            'code' => 'online',
            'name' => 'Online'
        ]);

        DataPrivacyTypeOption::create([
            'code' => 'offline',
            'name' => 'Offline'
        ]);

        DataPrivacyTypeOption::create([
            'code' => 'all',
            'name' => 'Todos'
        ]);

        DataPrivacyTypeOption::create([
            'code' => 'following',
            'name' => 'Pessoas que eu sigo'
        ]);

        DataPrivacyTypeOption::create([
            'code' => 'anyone',
            'name' => 'Ninguém'
        ]);
    }
}
