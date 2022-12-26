<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataCountry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DataCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://restcountries.com/v3.1/all');
        $countries = $response->json();

        if ($countries) {
            foreach ($countries as $country) {
                DataCountry::create([
                    'name' => $country['translations']['por']['common'],
                    'iso2' => $country['cca2'],
                    'iso3' => $country['cca3']
                ]);
            }
        }
    }
}
