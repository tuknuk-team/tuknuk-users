<?php

namespace App\Http\Requests\Auth;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', 'string', 'exists:users,email']
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
            'email.required' => __('Informe o e-mail da conta'),
            'email.email' => __('O e-mail informado é inválido'),
            'email.exists' => __('O e-mail informado não foi encontrado'),
        ];
    }
}
