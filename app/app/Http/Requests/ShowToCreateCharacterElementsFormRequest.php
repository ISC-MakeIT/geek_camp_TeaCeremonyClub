<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowToCreateCharacterElementsFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'characterId' => ['required', 'string', 'uuid', 'exists:characters,id'],
        ];
    }

    public function all($keys = null): array
    {
        $requestData = parent::all();
        $requestData['characterId'] = $this->route('characterId');

        return $requestData;
    }
}
