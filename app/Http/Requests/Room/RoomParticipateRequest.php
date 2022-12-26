<?php

namespace App\Http\Requests\Room;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RoomParticipateRequest extends FormRequest
{
    use FailedValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'room_uuid' => ['required', 'exists:rooms,uuid']
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'room_uuid.required' => __('Selecione a sala que deseja participar.'),
            'room_uuid.exists' => __('A sala selecionada é inválida.'),
        ];
    }
}
