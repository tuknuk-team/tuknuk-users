<?php

namespace App\Http\Requests\Chat;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
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
            'message' => ['required', 'string', 'max:258']
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
            'message.required' => __('Escreva a mensagem que deseja enviar no chat.'),
        ];
    }
}
