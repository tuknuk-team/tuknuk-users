<?php

namespace App\Http\Requests\Auth;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token'     => ['required', 'exists:password_resets_token,token'],
            'password'  => ['required', 'confirmed', 'min:6'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'token.required'    => __('O token de recuperação é obrigatório'),
            'token.exists'    => __('O token de recuperação é inválido'),
            'password.required' => __('Informe a sua nova senha'),
            'password.confirmed' => __('A confirmação da senha esta incorreta'),
            'password.min' => __('A senha deve conter no mínimo 6 dígitos'),
        ];
    }
}
