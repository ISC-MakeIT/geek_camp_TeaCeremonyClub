<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatroomRequest;
use App\Http\Requests\ShowToCreateCharacterElementsFormRequest;
use App\Http\Requests\ShowToCreateChatroomFormRequest;
use App\Models\Character;
use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatroomController extends Controller
{
    public function showToCreateChatroomForm(ShowToCreateChatroomFormRequest $request)
    {
        $validatedRequest = $request->validated();
        $character = Character::findOneByCharacterIdAndUserId($validatedRequest['characterId'], auth()->id());

        $createdFormLabels = Chatroom::createFormLabels($validatedRequest['purpose']);

        session(['purposeTemporality' => $validatedRequest['purpose']]);
        session(['formLabelsTemporality' => $createdFormLabels]);

        return view('createChatroomForm', ['formLabels' => $createdFormLabels, 'character' => $character]);
    }

    public function showToCreateCharacterElementsForm(ShowToCreateCharacterElementsFormRequest $request): View | Factory
    {
        $validatedRequest = $request->validated();
        $character = Character::findOneByCharacterIdAndUserId($validatedRequest['characterId'], auth()->id());

        return view('createCharacterElementsForm', ['character' => $character]);
    }

    public function createChatroom(CreateChatroomRequest $request)
    {
        $validatedRequest = $request->validated();
        $character = Character::findOneByCharacterIdAndUserId($validatedRequest['characterId'], auth()->id());

        $formLabels = session('formLabelsTemporality');
        $purpose    = session('purposeTemporality');

        $characterElements = $request->only($formLabels);

        Chatroom::create([
            'id'                 => Str::uuid()->toString(),
            'character_id'       => $validatedRequest['characterId'],
            'purpose'            => $purpose,
            'character_elements' => $characterElements,
            'creator'            => auth()->id(),
        ]);

        return redirect('/');
    }
}
