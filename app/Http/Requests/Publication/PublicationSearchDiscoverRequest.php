<?php

namespace App\Http\Requests\Publication;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PublicationSearchDiscoverRequest extends FormRequest
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
            'type' => ['required', 'in:movie,serie'],
            'query' => ['string', 'max:255'],
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
            'type.required' => __('Informe o tipo.'),
            'type.exists' => __('O tipo não existe.'),
            'query.required' => __('Digite o título do que você deseja pesquisar.'),
        ];
    }
}
