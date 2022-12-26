<?php

namespace App\Http\Requests\Publication;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PublicationCreateRequest extends FormRequest
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
            'type_code' => ['required', 'exists:publications_type,code'],
            'text' => ['required', 'string', 'max:255'],
            'is_private' => ['required', 'boolean'],
            'is_draft' => ['required', 'boolean'],
            'is_spoiler' => ['required', 'boolean'],
            'interest_id' => ['nullable', 'exists:data_interests,id'],
            'survey.*' => ['required_if:type_code,survey'],
            'archive' => ['required_if:type_code,image,video', 'file', 'mimes:jpg,png,jpeg,mov,mp4,pdf', 'max:62000'],
            'discover_type' => ['nullable', 'in:movie,serie,music,book'],
            'discover_data.*' => ['required_if:discover_type,movie,serie,book,music'],
            'discover_data.title' => ['nullable', 'string', 'max:255'],
            'discover_data.description' => ['nullable', 'string', 'max:800'],
            'discover_data.image' => ['nullable', 'string', 'max:255'],
            'discover_data.embed' => ['required_if:discover_type,music', 'string', 'max:255'],
            'discover_data.link' => ['nullable', 'string', 'max:255'],
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
            'type_code.required' => __('Informe o tipo de publicação.'),
            'type_code.exists' => __('O tipo de publicação não existe.'),
            'is_private.required' => __('Informe se a publicação é privada ou não.'),
            'is_draft.required' => __('Informe se a publicação é um rascunho ou não.'),
            'is_spoiler.required' => __('Informe se a publicação é um spoiler ou não.'),
            'interest_id.exists' => __('A categoria do interesse selecionada é inválida.'),
            'survey.required_if' => __('É preciso criar as perguntas da sua enquete.'),
            'archive.required' => __('Selecione uma imagem de archive'),
            'archive.file' => __('O arquivo deve ser um arquivo de vídeo ou imagem.'),
            'archive.mimes' => __('Para o arquivo o arquivo deve ser JPG, PNG, MOV, MP4, PDF'),
            'archive.max' => __('O tamanho máximo aceito de um arquivo é de 62MB'),
        ];
    }
}
