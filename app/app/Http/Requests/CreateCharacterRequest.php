<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCharacterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'between:1,255'],
            'age'               => ['required', 'numeric', 'between:0,120'],
            'sex'               => ['required', 'string', 'between:0,6', 'in:man,woman,others'],
            'icon'              => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'extraversion'      => ['required', 'numeric', 'between:0,100'],
            'agreeableness'     => ['required', 'numeric', 'between:0,100'],
            'conscientiousness' => ['required', 'numeric', 'between:0,100'],
            'neuroticism'       => ['required', 'numeric', 'between:0,100'],
            'openness'          => ['required', 'numeric', 'between:0,100'],
        ];
    }
}
