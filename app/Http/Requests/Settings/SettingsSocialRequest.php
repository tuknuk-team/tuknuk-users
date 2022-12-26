<?php

namespace App\Http\Requests\Settings;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingsSocialRequest extends FormRequest
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
            'link_facebook' => ['nullable', 'string', 'max:255'],
            'link_instagram' => ['nullable', 'string', 'max:255'],
            'link_twitter' => ['nullable', 'string', 'max:255'],
            'link_tiktok' => ['nullable', 'string', 'max:255'],
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

        ];
    }
}
