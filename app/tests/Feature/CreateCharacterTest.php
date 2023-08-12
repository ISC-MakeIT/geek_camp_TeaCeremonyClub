<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCharacterTest extends TestCase
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

        $request = [
            'name'              => 'test',
            'age'               => 10,
            'sex'               => 'man',
            'icon'              => $icon,
            'extraversion'      => 50,
            'agreeableness'     => 50,
            'conscientiousness' => 50,
            'neuroticism'       => 50,
            'openness'          => 50,
        ];

        $response = $this->post(
            '/character',
            $request
        );

        $response->assertStatus(302);
        $response->assertRedirect('/');

        /** @var Character */
        $foundCharacter = Character::where('name', 'test')->first();

        $this->assertNotNull($foundCharacter);
        $this->assertEquals($request['name'], $foundCharacter->getName());
        $this->assertEquals($request['age'], $foundCharacter->getAge());
        $this->assertEquals($request['sex'], $foundCharacter->getSexInEn());
        $this->assertEquals($request['extraversion'], $foundCharacter->getExtraversion());
        $this->assertEquals($request['agreeableness'], $foundCharacter->getAgreeableness());
        $this->assertEquals($request['conscientiousness'], $foundCharacter->getConscientiousness());
        $this->assertEquals($request['neuroticism'], $foundCharacter->getNeuroticism());
        $this->assertEquals($request['openness'], $foundCharacter->getOpenness());
        $this->assertEquals(auth()->id(), $foundCharacter->getCreator());
        $this->assertEquals(auth()->id(), $foundCharacter->getUpdater());
    }

    public function test_キャラクターの作成時にバリデーションを行うこと(): void
    {
		Storage::fake('files');
		Storage::fake('s3');

		$icon = UploadedFile::fake()->image('dummy.png', 800, 800);

        $request = [
            'name'              => 'test',
            'age'               => 10,
            'sex'               => 'man',
            'icon'              => $icon,
            'extraversion'      => 101,
            'agreeableness'     => 50,
            'conscientiousness' => 50,
            'neuroticism'       => 50,
            'openness'          => 50,
        ];

        $response = $this->post(
            '/character',
            $request
        );

        $response->assertStatus(302);
        $response->assertRedirect('/');

        /** @var Character */
        $foundCharacter = Character::where('name', 'test')->first();

        $this->assertNull($foundCharacter);
    }
}
