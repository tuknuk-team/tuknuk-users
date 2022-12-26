<?php

namespace App\Http\Requests\Settings;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingsNotificationsRequest extends FormRequest
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
            'code' => ['required', 'exists:data_notification_types,code'],
            'status' => ['required', 'boolean'],
            'code_channel' => ['nullable', 'exists:data_notification_channels,code']
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
            'code.required' => __('Tipo de notificação é obrigatório.'),
            'code.exists' => __('O tipo de notificação selecionado não existe.'),
            'status.required' => __('Selecione o status da notificação.'),
            'status.boolean' => __('O status da notificação deve ser true ou false.'),
            'code_channel.exists' => __('O tipo de canal de notificação selecionado não existe.'),
        ];
    }
}
