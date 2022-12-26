<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataGenre;
use Illuminate\Database\Seeder;

class DataGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataGenre::create([
            'name' => 'Masculino',
        ]);

        DataGenre::create([
            'name' => 'Feminino',
        ]);

        DataGenre::create([
            'name' => 'Não informar',
        ]);
    }
}
