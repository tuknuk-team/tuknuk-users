<?php

namespace App\Http\Requests\Settings;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingsPrivacyRequest extends FormRequest
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
            'code' => ['required', 'exists:data_privacy_types,code'],
            'option_code' => ['required', 'exists:data_privacy_types_options,code'],
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
            'code.required' => __('Tipo de privacidade é obrigatório.'),
            'code.exists' => __('O tipo de privacidade selecionado não existe.'),
            'option_code.required' => __('Tipo de opção privacidade é obrigatório.'),
            'option_code.exists' => __('O tipo de opção privacidade selecionado não existe.'),
        ];
    }
}
