<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UpdateUserNameAndEmailTest extends TestCase
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

    public function test_ユーザーの名前とメールアドレスの更新を行うこと(): void
    {
        $latestName = 'latestName';
        $latestEmail = 'test@aa.aa';

        $updateUserNameAndEmail = new UpdateUserProfileInformation();
        $updateUserNameAndEmail->update($this->currentUser, [
            'current_name'  => $this->currentUser->getName(),
            'current_email' => $this->currentUser->getEmail(),
            'name'          => $latestName,
            'email'         => $latestEmail,
        ]);

        $foundUser = User::find($this->currentUser->getId());

        $this->assertEquals($this->currentUser->getId(), $foundUser->getId());
        $this->assertEquals($latestEmail, $foundUser->getEmail());
        $this->assertEquals($latestName, $foundUser->getName());
    }

    public function test_ユーザの名前とメールアドレスの更新時にバリデーションに失敗した場合エラーが発生すること(): void
    {
        try {
            $updateUserNameAndEmail = new UpdateUserProfileInformation();
            $updateUserNameAndEmail->update($this->currentUser, [
                'name' => '',
                'email' => '',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('email', $e->errors());
        }

        try {
            $updateUserNameAndEmail = new UpdateUserProfileInformation();
            $updateUserNameAndEmail->update($this->currentUser, [
                'name' => 1,
                'email' => 1,
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('email', $e->errors());
        }

        try {
            $updateUserNameAndEmail = new UpdateUserProfileInformation();
            $updateUserNameAndEmail->update($this->currentUser, [
                'name' => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
                'email' => 'exampleEmail',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('email', $e->errors());
        }
    }
}
