<?php

namespace App\Http\Requests\Onboarding;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class StepFourRequest extends FormRequest
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
            'is_private' => ['nullable', 'boolean'],
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
            'is_private.boolean' => __('Altere a visibilidade do seu perfil')
        ];
    }
}
