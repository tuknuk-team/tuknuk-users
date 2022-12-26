<?php

namespace App\Http\Requests\Onboarding;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class StepTwoRequest extends FormRequest
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
            'interest.*' => ['required', 'exists:data_interests,id'],
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
            'interest.required' => __('Selecione os seus interesses'),
            'interest.exists' => __('Interesse selecionado inválido'),
        ];
    }
}
