<?php

namespace App\Http\Requests\Settings;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingsComplianceRequest extends FormRequest
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
            'front_document' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'back_document' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
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
            'front_document.required' => __('Faça Upload da frente do documento'),
            'front_document.mimes' => __('O arquivo pode ser: PDF, JPG ou PNG'),
            'front_document.max' => __('O arquivo deve ter no máximo 2MB'),
            'back_document.mimes' => __('O arquivo pode ser: PDF, JPG ou PNG'),
            'back_document.max' => __('O arquivo deve ter no máximo 2MB'),
        ];
    }
}
