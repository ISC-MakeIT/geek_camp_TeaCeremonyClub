<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public $fillable = [
        'chatroom_id',
        'role',
        'content',
        'creator',
        'sended_at'
    ];

    public function getChatroomId(): string
    {
        return $this->chatroom_id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreator(): int
    {
        return $this->creator;
    }

    public function getSendedAt(): CarbonImmutable
    {
        return new CarbonImmutable($this->sended_at);
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return new CarbonImmutable($this->created_at);
    }

    public static function findAllByChatroomId(string $chatroomId): Collection
    {
        return Chat::where('chatroom_id', $chatroomId)->orderBy('sended_at', 'ASC')->get();
    }

    public static function createToSend(string $chatroomId, string $content, string $purpose, array $characterElements)
    {
        if (Chat::where('chatroom_id', $chatroomId)->get()->isEmpty()) {
            Chat::create([
                'role'        => 'system',
                'content'     => 'prompt mock',
                'chatroom_id' => $chatroomId,
                'creator'     => auth()->id(),
                'sended_at'   => CarbonImmutable::now(),
            ]);
        }

        Chat::create([
            'role'        => 'user',
            'content'     => $content,
            'chatroom_id' => $chatroomId,
            'creator'     => auth()->id(),
            'sended_at'   => CarbonImmutable::now(),
        ]);
    }

    public static function createResponse(string $content, string $chatroomId)
    {
        Chat::create([
            'role'        => 'assistant',
            'content'     => 'response mock',
            'chatroom_id' => $chatroomId,
            'creator'     => auth()->id(),
            'sended_at'   => CarbonImmutable::now(),
        ]);
    }
}
