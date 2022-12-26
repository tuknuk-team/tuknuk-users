<?php

namespace App\Http\Requests\Publication;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PublicationCommentRequest extends FormRequest
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
            'comment' => ['required', 'string', 'max:255'],
            'comment_id_parent' => ['nullable', 'exists:publications_comments,id'],
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
            'comment.required' => __('Escreva o seu comentário.'),
            'comment.max' => __('O comentário pode ter até 255 carácteres.'),
            'comment_id_parent.exists' => __('O comentário pai não foi encontrado.'),
        ];
    }
}
