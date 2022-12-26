<?php

namespace App\Http\Requests\Search;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SearchUsernameRequest extends FormRequest
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
            'username' => ['required', 'string'],
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
            'username.required' => __('Digite o usuário que deseja procurar.'),
        ];
    }
}
