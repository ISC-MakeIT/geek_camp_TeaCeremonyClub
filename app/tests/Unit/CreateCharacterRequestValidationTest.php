<?php

namespace Tests\Unit;

use App\Http\Requests\CreateCharacterRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateCharacterRequestValidationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_キャラクター作成時のバリデーションに失敗すること(): void
    {
		Storage::fake('files');

        $createCharacterRequestValidationRules = (new CreateCharacterRequest())->rules();

        $validator = Validator::make([
            'name'              => null,
            'age'               => null,
            'sex'               => null,
            'icon'              => null,
            'extraversion'      => null,
            'agreeableness'     => null,
            'conscientiousness' => null,
            'neuroticism'       => null,
            'openness'          => null,
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'name'              => 1,
            'age'               => 'a',
            'sex'               => 1,
            'icon'              => 'a',
            'extraversion'      => 'a',
            'agreeableness'     => 'a',
            'conscientiousness' => 'a',
            'neuroticism'       => 'a',
            'openness'          => 'a',
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'name'              => 1,
            'age'               => 'a',
            'sex'               => 1,
            'icon'              => 'a',
            'extraversion'      => 'a',
            'agreeableness'     => 'a',
            'conscientiousness' => 'a',
            'neuroticism'       => 'a',
            'openness'          => 'a',
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());

		$icon = UploadedFile::fake()->image('dummy.gif', 800, 800);

        $validator = Validator::make([
            'name'              => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
            'age'               => -1,
            'sex'               => 'max6max6',
            'icon'              => $icon,
            'extraversion'      => -1,
            'agreeableness'     => -1,
            'conscientiousness' => -1,
            'neuroticism'       => -1,
            'openness'          => -1,
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());

		$icon = UploadedFile::fake()->image('dummy.gif', 800, 800);

        $validator = Validator::make([
            'name'              => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
            'age'               => -1,
            'sex'               => 'max6max6',
            'icon'              => $icon,
            'extraversion'      => -1,
            'agreeableness'     => -1,
            'conscientiousness' => -1,
            'neuroticism'       => -1,
            'openness'          => -1,
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());

		$icon = UploadedFile::fake()->image('dummy.png', 800, 800);

        $validator = Validator::make([
            'name'              => '123',
            'age'               => 121,
            'sex'               => 'aaaaa',
            'icon'              => $icon,
            'extraversion'      => 101,
            'agreeableness'     => 101,
            'conscientiousness' => 101,
            'neuroticism'       => 101,
            'openness'          => 101,
        ], $createCharacterRequestValidationRules);

        $this->assertTrue($validator->fails());
    }
}
