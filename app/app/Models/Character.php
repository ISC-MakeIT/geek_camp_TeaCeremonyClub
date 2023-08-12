<?php

namespace App\Models;

use App\Exceptions\File\FailedUploadFileException;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Character extends Model
{
    use HasFactory;

    private const UPLOAD_ICON_TO_S3_PATH = "/image/icon";

    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'name',
        'sex',
        'age',
        'icon',
        'extraversion',
        'agreeableness',
        'conscientiousness',
        'neuroticism',
        'openness',
        'creator',
        'updater'
    ];

    public static function createFromCharacterElements(
        string $name,
        string $sex,
        int $age,
        UploadedFile $icon,
        int $extraversion,
        int $agreeableness,
        int $conscientiousness,
        int $neuroticism,
        int $openness,
        int $creator
    ): Character {
        $adjustedIcon    = self::adjustIcon($icon);
        $uploadedIconUrl = self::uploadIcon($adjustedIcon);

        return Character::create([
            'id'                => Str::uuid(),
            'name'              => $name,
            'sex'               => $sex,
            'age'               => $age,
            'icon'              => $uploadedIconUrl,
            'extraversion'      => $extraversion,
            'agreeableness'     => $agreeableness,
            'conscientiousness' => $conscientiousness,
            'neuroticism'       => $neuroticism,
            'openness'          => $openness,
            'creator'           => $creator,
            'updater'           => $creator,
        ]);
    }

    private static function adjustIcon(UploadedFile $icon): string
    {
        $nowDateTime                  = CarbonImmutable::now()->format('YmdHis');
        $randomString                 = str_replace(' ', '_', Str::random(24));
        $toUseIconFileNameTemporarily = "/tmp/{$nowDateTime}_{$randomString}";

        Image::make($icon)
            ->fit(480, 480)
            ->save($toUseIconFileNameTemporarily, 20, 'jpg');

        return $toUseIconFileNameTemporarily;
    }

    private static function uploadIcon(string $path): string
    {
        /** @var \Illuminate\Filesystem\AwsS3V3Adapter */
        $s3Storage = Storage::disk('s3');

        $uploadedIconPath = $s3Storage->putFile(
            self::UPLOAD_ICON_TO_S3_PATH,
            new File($path),
            'public'
        );

        // dd($uploadedIconPath);
        if (!$uploadedIconPath) {
            throw new FailedUploadFileException();
        }

        return $s3Storage->url($uploadedIconPath);
    }

    public static function findAllByUserId(int $userId): Collection
    {
        return Character::where('creator', $userId)->get();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSexInEn(): string
    {
        return $this->sex;
    }

    public function getSexInJa(): string
    {
        if ($this->getSexInEn() === 'man') {
            return '男';
        }

        if ($this->getSexInEn() === 'woman') {
            return '女';
        }

        return 'その他';
    }

    public function getAge(): int
    {
        return $this->age;
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

    public function getUpdater(): int
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
