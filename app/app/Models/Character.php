<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'name',
        'sex',
        'icon',
        'extraversion',
        'agreeableness',
        'conscientiousness',
        'neuroticism',
        'openness',
        'creator',
        'updater'
    ];

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getExtraversion(): int
    {
        return $this->extraversion;
    }

    public function getAgreeableness(): int
    {
        return $this->agreeableness;
    }

    public function getConscientiousness(): int
    {
        return $this->conscientiousness;
    }

    public function getNeuroticism(): int
    {
        return $this->neuroticism;
    }

    public function getOpenness(): int
    {
        return $this->openness;
    }

    public function getCreator(): int
    {
        return $this->creator;
    }

    public function getUpdator(): int
    {
        return $this->updater;
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
