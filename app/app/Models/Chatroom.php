<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Chatroom extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = ['character_elements' => 'json'];

    public $fillable = [
        'id',
        'character_id',
        'purpose',
        'character_elements',
        'creator',
    ];

    public function getId(): string
    {
        return $this->id;
    }

    public function getCharacterId(): string
    {
        return $this->character_id;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }

    public function getCharacterElements(): array
    {
        return $this->character_elements;
    }

    public function getCreator(): int
    {
        return $this->creator;
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return new CarbonImmutable($this->created_at);
    }

    public function getUpdatedAt(): CarbonImmutable
    {
        return new CarbonImmutable($this->updated_at);
    }

    public static function createFormLabels(Character $character, string $purpose): array
    {
        $chatGPT = new ChatGPT(new Client());

        $responseMessage = $chatGPT->send(
            [
                [
                    "role"    => "system",
                    "content" => "あなたは、{心理カウンセリングのプロフェッショナル}です。"
                ],
                [
                    "role"    => "user",
                    "content" => view('chatgpt.prompt.createFormLabels', [
                        'age' => $character->getAge(),
                        'sex' => $character->getSexInJa(),
                        'purpose' => $purpose,
                        'extraversion' => $character->getExtraversion(),
                        'agreeableness' => $character->getAgreeableness(),
                        'conscientiousness' => $character->getConscientiousness(),
                        'neuroticism' => $character->getNeuroticism(),
                        'openness' => $character->getOpenness(),
                    ])->render(),
                ],
            ],
            [
                [
                    "name"        => "createFormLabels",
                    "description" => "{対象のことを深く知るため and 目的を叶えるために必要な要素}に必要なラベル一覧。 例:{$character->getName()}の現在の状況",
                    "parameters"  => [
                        "type"         => "object",
                        "properties"   => [
                            "labels"   => [
                                "type" => "array",
                                "description" => "フォームのラベルの配列 例:{$character->getName()}の現在の状況",
                                "items"       => [
                                    "type" => "string"
                                ]
                            ]
                        ],
                        "required" => ["labels"]
                    ]
                ]
            ]
        );

        return json_decode($responseMessage['message']["function_call"]["arguments"], true, 512, JSON_THROW_ON_ERROR)['labels'];
    }

    public static function findAllByUserId(int $userId): Collection
    {
        return Chatroom::where('creator', $userId)->get();
    }

    public static function findOneByChatroomIdAndUserId(string $chatroomId, int $userId): Chatroom
    {
        return Chatroom::where('creator', $userId)->findOrFail($chatroomId);
    }

    public static function createChat(string $content, string $chatroomId)
    {
        DB::transaction(function() use ($content, $chatroomId) {
            $chatroom  = Chatroom::findOneByChatroomIdAndUserId($chatroomId, auth()->id());
            $character = Character::findOneByCharacterId($chatroom->getCharacterId());

            Chat::createToSend(
                $chatroom->getId(),
                $content,
                $chatroom->getPurpose(),
                $character,
                $chatroom->getCharacterElements(),
            );
            Chat::createResponse($chatroom->getId());
        });
    }
}
