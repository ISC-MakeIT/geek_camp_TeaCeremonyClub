<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public static function createFormLabels(string $purpose): array
    {
        return ['趣味', '状況'];
    }

    public static function findAllByUserId(int $userId): Collection
    {
        return Chatroom::where('creator', $userId)->get();
    }
}
