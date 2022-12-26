<?php

namespace App\Http\Requests\Settings;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingsSecurity2FaDisableRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code_twoauth' => ['required', 'string', 'digits:6']
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
            'code_twoauth.required' => __('O código 2fa é obrigatório.'),
            'code_twoauth.digits' => __('O código deve ter no mínimo 6 dígitos.'),
        ];
    }
}
