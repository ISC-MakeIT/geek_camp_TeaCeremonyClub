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
    public function test_ユーザーの名前とメールアドレスの更新を行うこと(): void
    {
        $name = 'name';
        $latestName = 'latestName';

        $email = 'test@a.aa';
        $latestEmail = 'test@aa.aa';

        $password = '12345678';

        $currentUser = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->actingAs($currentUser);

        $updateUserNameAndEmail = new UpdateUserProfileInformation();
        $updateUserNameAndEmail->update($currentUser, [
            'current_name' => $name,
            'current_email' => $email,
            'name' => $latestName,
            'email' => $latestEmail,
        ]);

        $foundUser = User::find($currentUser->getId());

        $this->assertEquals($currentUser->getId(), $foundUser->getId());
        $this->assertEquals($latestEmail, $foundUser->getEmail());
        $this->assertEquals($latestName, $foundUser->getName());
        $this->assertTrue(Hash::check($password, $foundUser->getHashedPassword()));
    }

    public function test_ユーザの名前とメールアドレスの更新時にバリデーションに失敗した場合エラーが発生すること(): void
    {
        $password = '12345678';

        $currentUser = User::create([
            'name'     => 'test',
            'email'    => 'test@a.aa',
            'password' => $password,
        ]);

        $this->actingAs($currentUser);

        try {
            $updateUserNameAndEmail = new UpdateUserProfileInformation();
            $updateUserNameAndEmail->update($currentUser, [
                'name' => 'max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255max255',
                'email' => 'exampleEmail',
            ]);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('email', $e->errors());
        }
    }
}
