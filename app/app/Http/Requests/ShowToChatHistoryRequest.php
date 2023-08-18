<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowToChatHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'chatroomId' => ['required', 'string', 'uuid', 'exists:chatrooms,id'],
        ];
    }

    public function all($keys = null): array
    {
        $requestData = parent::all();
        $requestData['chatroomId'] = $this->route('chatroomId');

        return $requestData;
    }
}
