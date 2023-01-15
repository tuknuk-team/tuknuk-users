<?php

namespace App\Http\Requests\Auth;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            'code'     => ['required', 'exists:users,verification_code'],
            'email'     => ['required', 'exists:users,email'],
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
            'code.required'    => __('O código de autenticação é obrigatório'),
            'code.exists'    => __('O código de autenticação é inválido'),
            'email.required'    => __('O email é obrigatório'),
            'email.exists'    => __('O email é inválido'),
        ];
    }
}
