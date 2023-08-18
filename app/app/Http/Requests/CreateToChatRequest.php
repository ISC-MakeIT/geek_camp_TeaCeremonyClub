<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateToChatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'chatroomId' => ['required', 'string', 'uuid', 'exists:chatrooms,id'],
            'content' => ['required', 'string', 'between:0,2048'],
        ];
    }

    public function all($keys = null): array
    {
        $requestData = parent::all();
        $requestData['chatroomId'] = $this->route('chatroomId');

        return $requestData;
    }
}
