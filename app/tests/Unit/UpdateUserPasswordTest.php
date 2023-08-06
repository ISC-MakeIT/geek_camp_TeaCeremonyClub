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

    private User $currentUser;
    private string $password = '12345678';

    protected function setUp(): void
    {
        parent::setUp();

        $this->currentUser = User::create([
            'name'     => 'name',
            'email'    => 'test@a.aa',
            'password' => Hash::make($this->password),
        ]);

        $this->actingAs($this->currentUser);
    }

    public function test_ユーザーのパスワードの更新を行うこと(): void
    {
        $latestPassword = '123456789';

        $updateUserPassword = new UpdateUserPassword();
        $updateUserPassword->update($this->currentUser, [
            'current_password' => $this->password,
            'password' => $latestPassword,
            'password_confirmation' => $latestPassword,
        ]);

        $foundUser = User::find($this->currentUser->getId());

        $this->assertEquals($this->currentUser->getId(), $foundUser->getId());
        $this->assertEquals($this->currentUser->getEmail(), $foundUser->getEmail());
        $this->assertEquals($this->currentUser->getName(), $foundUser->getName());
        $this->assertTrue(Hash::check($latestPassword, $foundUser->getHashedPassword()));
    }

    public function test_ユーザーのパスワードの更新時にバリデーションに失敗した場合エラーが発生すること(): void
    {
        try {
            $updateUserPassword = new UpdateUserPassword();
            $updateUserPassword->update($this->currentUser, [
                'current_password'      => '',
                'password'              => '',
                'password_confirmation' => '',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('current_password', $e->errors());
            $this->assertArrayHasKey('password', $e->errors());
        }

        try {
            $updateUserPassword = new UpdateUserPassword();
            $updateUserPassword->update($this->currentUser, [
                'current_password'      => 1,
                'password'              => 1,
                'password_confirmation' => 1,
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('current_password', $e->errors());
            $this->assertArrayHasKey('password', $e->errors());
        }

        try {
            $updateUserPassword = new UpdateUserPassword();
            $updateUserPassword->update($this->currentUser, [
                'current_password'      => '123',
                'password'              => '1234',
                'password_confirmation' => '12345',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('current_password', $e->errors());
            $this->assertArrayHasKey('password', $e->errors());
        }
    }
}
