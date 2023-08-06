<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function test_ユーザーのパスワードの更新を行うこと(): void
    {
        $password = '12345678';
        $latestPassword = '123456789';

        $currentUser = User::create([
            'name'     => 'test',
            'email'    => 'test@a.aa',
            'password' => Hash::make($password),
        ]);

        $this->actingAs($currentUser);

        $updateUserPassword = new UpdateUserPassword();
        $updateUserPassword->update($currentUser, [
            'current_password' => $password,
            'password' => $latestPassword,
            'password_confirmation' => $latestPassword,
        ]);

        $foundUser = User::find($currentUser->getId());

        $this->assertEquals($currentUser->getId(), $foundUser->getId());
        $this->assertEquals($currentUser->getEmail(), $foundUser->getEmail());
        $this->assertEquals($currentUser->getName(), $foundUser->getName());
        $this->assertTrue(Hash::check($latestPassword, $foundUser->getHashedPassword()));
    }

    public function test_ユーザーのパスワードの更新時にバリデーションに失敗した場合エラーが発生すること(): void
    {
        $password = '12345678';

        $currentUser = User::create([
            'name'     => 'test',
            'email'    => 'test@a.aa',
            'password' => Hash::make($password),
        ]);

        $this->actingAs($currentUser);

        try {
            $updateUserPassword = new UpdateUserPassword();
            $updateUserPassword->update($currentUser, [
                'current_password' => '123',
                'password' => '1234',
                'password_confirmation' => '12345',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('current_password', $e->errors());
            $this->assertArrayHasKey('password', $e->errors());
        }
    }
}
