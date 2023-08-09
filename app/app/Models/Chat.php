<?php

namespace App\Model;

use Carbon\CarbonImmutable;
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
}
