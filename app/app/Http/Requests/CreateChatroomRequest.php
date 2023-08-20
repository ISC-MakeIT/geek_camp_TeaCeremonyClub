<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChatroomRequest extends FormRequest
{
    public function rules(): array
    {
        $toValidateForm = [];

        $formLabels = session('formLabelsTemporality');

        foreach ($formLabels as $formLabel) {
            $toValidateForm[$formLabel] = ['required', 'string', 'max:512'];
        }

        return array_merge([
            'characterId' => ['required', 'string', 'uuid', 'exists:characters,id'],
        ], $toValidateForm);
    }
}
