<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'charactor_id',
        'purpose',
        'charactor_elements',
        'creator',
    ];

    public function getId(): string
    {
        return $this->id;
    }

    public function getCharactorId(): string
    {
        return $this->charactor_id;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }

    public function getCharactorElements(): array
    {
        return $this->charactor_elements;
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
}
