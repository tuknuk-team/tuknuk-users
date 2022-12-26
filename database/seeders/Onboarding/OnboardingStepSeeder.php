<?php

namespace Database\Seeders\Onboarding;

use App\Models\Onboarding\OnboardingStep;
use Illuminate\Database\Seeder;

class OnboardingStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnboardingStep::create([
            'level' => 1,
            'name' => 'Perfil público',
        ]);

        OnboardingStep::create([
            'level' => 2,
            'name' => 'Interesses',
        ]);

        OnboardingStep::create([
            'level' => 3,
            'name' => 'Sugestões',
        ]);

        OnboardingStep::create([
            'level' => 4,
            'name' => 'Concluir',
        ]);
    }
}
