<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataPrivacyType;
use App\Models\Data\DataPrivacyTypeOption;
use App\Models\Data\DataPrivacyTypeOptionConnect;
use Illuminate\Database\Seeder;

class DataPrivacyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = DataPrivacyType::create([
            'code' => 'status',
            'name' => 'Status'
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $status->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'online')->first()->id,
            'is_default' => true,
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $status->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'offline')->first()->id
        ]);

        $can_tag = DataPrivacyType::create([
            'code' => 'can_tag',
            'name' => 'Quem pode me marcar?'
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_tag->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'all')->first()->id,
            'is_default' => true
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_tag->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'following')->first()->id
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_tag->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'anyone')->first()->id
        ]);

        $can_send_message = DataPrivacyType::create([
            'code' => 'can_send_message',
            'name' => 'Quem pode me mandar mensagem?'
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_send_message->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'all')->first()->id,
            'is_default' => true
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_send_message->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'following')->first()->id
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_send_message->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'anyone')->first()->id
        ]);

        $can_invite_room = DataPrivacyType::create([
            'code' => 'can_invite_to_room',
            'name' => 'Quem pode me adicionar em grupos?'
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_invite_room->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'all')->first()->id,
            'is_default' => true
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_invite_room->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'following')->first()->id
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_invite_room->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'anyone')->first()->id
        ]);

        $can_see_my_birth_date = DataPrivacyType::create([
            'code' => 'can_see_my_birth_date',
            'name' => 'Quem pode ver a data de aniversário?'
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_see_my_birth_date->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'all')->first()->id,
            'is_default' => true
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_see_my_birth_date->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'following')->first()->id
        ]);

        DataPrivacyTypeOptionConnect::create([
            'privacy_type_id' => $can_see_my_birth_date->id,
            'privacy_type_option_id' => DataPrivacyTypeOption::where('code', 'anyone')->first()->id
        ]);
    }
}
