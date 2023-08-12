<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCharacterRequest;
use App\Models\Character;

class CharacterController extends Controller
{
    public function createCharacter(CreateCharacterRequest $request)
    {
        $validatedRequest = $request->validated();

        Character::createFromCharacterElements(
            $validatedRequest['name'],
            $validatedRequest['sex'],
            $validatedRequest['age'],
            $validatedRequest['icon'],
            $validatedRequest['extraversion'],
            $validatedRequest['agreeableness'],
            $validatedRequest['conscientiousness'],
            $validatedRequest['neuroticism'],
            $validatedRequest['openness'],
            auth()->id(),
        );

        return redirect('/');
    }
}
