<?php

namespace Tests\Unit;

use App\Http\Requests\CreateChatroomRequest;
use App\Http\Requests\ShowToCreateCharacterElementsFormRequest;
use App\Http\Requests\ShowToCreateChatroomFormRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Mockery;
use PHPUnit\Framework\MockObject\MockBuilder;
use Tests\CreatesApplication;

class CreateChatroomRequestValidationTest extends TestCase
{
    use DatabaseTransactions;

    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->createApplication();
    }

    public function test_チャットルーム作成の目的フォームのバリデーションに失敗すること(): void
    {
        $showToCreateChatroomFormRequestValidationRules = (new ShowToCreateChatroomFormRequest())->rules();

        $validator = Validator::make([
            'characterId' => null,
            'purpose'     => null,
        ], $showToCreateChatroomFormRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'characterId' => 1,
            'purpose'     => 1,
        ], $showToCreateChatroomFormRequestValidationRules);

        $validator = Validator::make([
            'characterId' => '123',
            'purpose'     => '1234',
        ], $showToCreateChatroomFormRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'characterId' => '123',
            'purpose'     => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
        ], $showToCreateChatroomFormRequestValidationRules);

        $this->assertTrue($validator->fails());
    }

    public function test_キャラクター要素作成フォームの生成のバリデーションに失敗すること(): void
    {
        $showToCreateCharacterElementsFormRequestValidationRules = (new ShowToCreateCharacterElementsFormRequest())->rules();

        $validator = Validator::make([
            'characterId' => null,
        ], $showToCreateCharacterElementsFormRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'characterId' => 1,
        ], $showToCreateCharacterElementsFormRequestValidationRules);

        $this->assertTrue($validator->fails());

        $validator = Validator::make([
            'characterId' => Str::uuid()->toString()
        ], $showToCreateCharacterElementsFormRequestValidationRules);

        $this->assertTrue($validator->fails());
    }
    // public function test_チャットルーム作成時のバリデーションに失敗すること(): void
    // {
    //     $createChatroomRequest = new CreateChatroomRequest();

    //     $createChatroomRequestValidationRules = $createChatroomRequest->rules();

    //     $validator = Validator::make([
    //         'characterId' => null,
    //         '趣味'         => null,
    //         '状況'         => null,
    //     ], $createChatroomRequestValidationRules);

    //     $this->assertTrue($validator->fails());

    //     $validator = Validator::make([
    //         'characterId' => 1,
    //         '趣味'        => 1,
    //         '状況'        => 1
    //     ], $createChatroomRequestValidationRules);

    //     $this->assertTrue($validator->fails());

    //     $validator = Validator::make([
    //         'characterId' => '123',
    //         '趣味'        => 'max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512',
    //         '状況'        => 'max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512max512',
    //     ], $createChatroomRequestValidationRules);

    //     $this->assertTrue($validator->fails());

    //     $validator = Validator::make([
    //         'characterId' => Str::uuid()->toString(),
    //         '趣味'        => 'aa',
    //         '状況'        => 'aa',
    //     ], $createChatroomRequestValidationRules);

    //     $this->assertTrue($validator->fails());
    // }
}
