<?php

namespace App\Http\Requests\Onboarding;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class StepOneRequest extends FormRequest
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
            'avatar' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'username' => ['required', 'alpha_dash', 'min:3', 'string', 'max:255', 'unique:users,username'.((!auth()->guest()) ? ','.auth()->user()->id : '')],
            'bio' => ['nullable', 'string', 'max:255'],
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
            'avatar.required' => __('Selecione uma imagem de avatar'),
            'avatar.image' => __('O avatar deve ser uma imagem válida'),
            'avatar.mimes' => __('Para o avatar o arquivo deve ser JPG ou PNG'),
            'username.required' => __('O nome de usuário é obrigatório'),
            'username.unique' => __('O nome de usuário já esta sendo utilizado'),
            'username.alpha_dash' => __('Não pode conter espaços'),
            'bio.max' => __('A bio pode conter até 255 carácteres')
        ];
    }
}
