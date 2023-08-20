<?php

namespace App\Models;

use GuzzleHttp\ClientInterface;

class ChatGPT
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function send(array $messages, array $functions): array
    {
        $response = $this->client->request(
            'POST',
            'https://api.openai.com/v1/chat/completions',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('chatgpt.token'),
                ],
                'json'    => array_merge([
                    'model'       => 'gpt-4-0613',
                    'messages'    => $messages,
                    'temperature' => 0.7,
                    'max_tokens'  => 2048,
                ], count($functions) == 0 ? [] : ['functions'   => $functions])
            ],
        );

        $content = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        return $content['choices'][0];
    }
}
