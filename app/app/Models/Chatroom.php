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

    public function character()
    {
        return $this->hasOne(Character::class, 'id', 'character_id');
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
                        'name' => $character->getName(),
                        'age'  => $character->getAge(),
                        'sex'  => $character->getSexInJa(),
                        'purpose' => $purpose,
                        'extraversion' => $character->getExtraversion(),
                        'agreeableness' => $character->getAgreeableness(),
                        'conscientiousness' => $character->getConscientiousness(),
                        'neuroticism' => $character->getNeuroticism(),
                        'openness' => $character->getOpenness(),
                    ])->render()
                ],
            ],
            [
                [
                    "name"        => "createFormLabels",
                    "description" => <<< EOM
                        # 命令書:
                        これは人格の基本要素とルームの作成目的から{$character->getName()}さんの詳細な情報を知るための処理です。
                        以下の制約条件と例を元に、最高のラベルを生成してください。

                        # 制約条件:
                        ・ラベルは2つ程度
                        ・人格が持っている特性以外のことは聞かない
                        ・ルーム作成の目的と筋の通る特性以外は聞かない

                        # 例:
                        目的が「{$character->getName()}のプリンを私が食べてしまった」場合
                        ラベルは「好きな食べ物」となる
                        解決策に必要な要素を要求してほしい。
                    EOM,
                    "parameters"  => [
                        "type"         => "object",
                        "properties"   => [
                            "labels"   => [
                                "type" => "array",
                                "description" => "フォームのラベルの配列",
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

        $labels = json_decode($responseMessage['message']["function_call"]["arguments"], true, 512, JSON_THROW_ON_ERROR)['labels'];

        $labels[] = "その他{$character->getName()}の性格";
        return $labels;
    }

    public static function findAllByUserId(int $userId): Collection
    {
        return Chatroom::with(['character'])->where('creator', $userId)->get();
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
