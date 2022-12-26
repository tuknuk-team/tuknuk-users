<?php

namespace App\Http\Requests\Chat;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateNewChatRequest extends FormRequest
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
            'username' => ['required', 'exists:users,username']
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
            'username.required' => __('Informe o username com quem quer conversar.'),
            'username.exists' => __('O username informado não existe.'),
        ];
    }
}
