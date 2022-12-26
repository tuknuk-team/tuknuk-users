<?php

namespace App\Http\Requests\Room;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RoomCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:450'],
            'max_users' => ['nullable', 'numeric'],
            'launch_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'avatar' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'cover' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'price' => ['nullable', 'numeric', 'not_in:0', 'min:0']
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
            'title.required' => __('Informe o título da sala.'),
            'title.max' => __('O título deve ter no máximo 255 carácteres.'),
            'description.required' => __('Informe a descrição da sala.'),
            'description.max' => __('A descrição deve ter no máximo 450 carácteres.'),
            'max_users.numeric' => __('O número máximo de participantes deve ser um número.'),
            'launch_at.date_format' => __('O formato da data do lançamento deve ser: Y-m-d H:i:s.'),
            'avatar.required' => __('Selecione uma imagem de avatar'),
            'avatar.image' => __('O avatar deve ser uma imagem válida'),
            'avatar.mimes' => __('Para o avatar o arquivo deve ser JPG ou PNG.'),
            'cover.required' => __('Selecione uma imagem de cover.'),
            'cover.image' => __('O cover deve ser uma imagem válida.'),
            'cover.mimes' => __('Para o cover o arquivo deve ser JPG ou PNG.'),
            'price.numeric' => __('O preço deve ser um número.'),
            'price.not_in' => __('O preço não pode ser zero.'),
        ];
    }
}
