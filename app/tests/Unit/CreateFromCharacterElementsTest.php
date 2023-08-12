<?php

namespace Tests\Unit;

use App\Exceptions\File\FailedUploadFileException;
use App\Models\Character;
use App\Models\User;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class CreateFromCharacterElementsTest extends TestCase
{
    use DatabaseTransactions;

    private User $currentUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->currentUser = User::create([
            'name'     => 'name',
            'email'    => 'test@a.aa',
            'password' => Hash::make('12345678'),
        ]);

        $this->actingAs($this->currentUser);
    }

    public function test_キャラクターの作成を行うこと(): void
    {
		Storage::fake('files');
		Storage::fake('s3');

		$icon = UploadedFile::fake()->image('dummy.png', 800, 800);

        $createdCaracter = Character::createFromCharacterElements(
            'test',
            'man',
            10,
            $icon,
            50,
            50,
            50,
            50,
            50,
            auth()->id(),
        );

        $foundCharacter = Character::find($createdCaracter->getId());

        $this->assertEquals($createdCaracter->toArray(), $foundCharacter->toArray());
    }

    public function test_キャラクター作成時に画像アップロードが失敗した場合エラーが発生すること(): void
    {
		Storage::fake('files');
		Storage::fake('s3');

		$icon = UploadedFile::fake()->image('dummy.png', 800, 800);

        Storage::shouldReceive('disk')
            ->with('s3')
            ->once()
            ->andReturn($s3StorageMocker = Mockery::mock(FilesystemAdapter::class));

        $s3StorageMocker->shouldReceive('putFile')
            ->once()
            ->andReturn(false);

        $this->expectException(FailedUploadFileException::class);

        Character::createFromCharacterElements(
            'test',
            'man',
            10,
            $icon,
            50,
            50,
            50,
            50,
            50,
            auth()->id(),
        );
    }
}
