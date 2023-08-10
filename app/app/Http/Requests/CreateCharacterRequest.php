<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!$this->path() == 'createCharacter') return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required | string | min:1 | max:100',
            'age' => 'required | integer',
            'sex' => 'required | string | min:1 | max:3',
            'icon' => [
                'required',
                'file',
                'image',
                'mimetypes:image/jpeg,image/png'
            ],
            'extraversion' => 'required | integer',
            'agreeableness' => 'required | integer',
            'conscientiousness' => 'required | integer',
            'neuroticism' => 'required | integer',
            'openness' => 'required | integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名前を入力してください',
            'name.between' => '100文字まで入力可能です',
            'age.numeric' => '整数で入力してください',
            'age.between' => '0～150で入力してください',
            'age.required' => '年齢を入力してください',
            'sex.required' => '性別を入力してください',
            'icon.required' => 'アイコンを設定してください',
            'extraversion.numeric' => '整数で入力してください',
            'extraversion.required' => '外向性を入力してください',
            'agreeableness.numeric' => '整数で入力してください',
            'agreeableness.required' => '協調性を入力してください',
            'conscientiousness.numeric' => '整数で入力してください',
            'conscientiousness.required' => '誠実性を入力してください',
            'neuroticism.numeric' => '整数で入力してください',
            'neuroticism.required' => '情緒安定性を入力してください',
            'openness.numeric' => '整数で入力してください',
            'openness.required' => '開放性を入力してください',

        ];
    }
}
