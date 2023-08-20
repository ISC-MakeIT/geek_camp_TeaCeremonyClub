<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowToCreateChatroomFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'characterId' => ['required', 'string', 'uuid', 'exists:characters,id'],
            'purpose' => ['required', 'string', 'between:10,255']
        ];
    }
}
