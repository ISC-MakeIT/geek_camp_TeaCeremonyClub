<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CreateNewUserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_ユーザーの作成を行うこと(): void
    {
        $createNewUser = new CreateNewUser();

        $password = '12345678';

        $createdUser = $createNewUser->create([
            'name'                  => 'test',
            'email'                 => 'test@a.aa',
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        $foundUser = User::find($createdUser->getId());

        $this->assertEquals($createdUser->getId(), $foundUser->getId());
        $this->assertEquals($createdUser->getName(), $foundUser->getName());
        $this->assertEquals($createdUser->getEmail(), $foundUser->getEmail());
        $this->assertTrue(Hash::check($password, $createdUser->getHashedPassword()));
    }

    public function test_ユーザー作成時にバリデーションに失敗した場合エラーが発生すること(): void
    {
        $createNewUser = new CreateNewUser();

        try {
            $createNewUser->create([
                'name'                  => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
                'email'                 => 'example',
                'password'              => '1234',
                'password_confirmation' => '12345',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('email', $e->errors());
            $this->assertArrayHasKey('password', $e->errors());
        }
    }
}
