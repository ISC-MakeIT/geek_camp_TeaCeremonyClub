<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatroomRequest;
use App\Http\Requests\CreateToChatRequest;
use App\Http\Requests\ShowToChatHistoryRequest;
use App\Http\Requests\ShowToCreateChatroomFormRequest;
use App\Models\Character;
use App\Models\Chatroom;
use App\Models\Chat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ChatroomController extends Controller
{
    public function showToCreateCharacterElementsForm(): View | Factory
    {
        $characters = Character::findAllByUserId(auth()->id());

        return view('createCharacterElementsForm', ['characters' => $characters]);
    }

    public function showToCreateChatroomForm(ShowToCreateChatroomFormRequest $request)
    {
        $validatedRequest = $request->validated();
        $character = Character::findOneByCharacterIdAndUserId($validatedRequest['characterId'], auth()->id());

        $createdFormLabels = Chatroom::createFormLabels($character, $validatedRequest['purpose']);

        session(['purposeTemporality' => $validatedRequest['purpose']]);
        session(['formLabelsTemporality' => $createdFormLabels]);

        return view('createChatroomForm', ['formLabels' => $createdFormLabels, 'character' => $character]);
    }

    public function createChatroom(CreateChatroomRequest $request)
    {
        $validatedRequest = $request->validated();
        Character::findOneByCharacterIdAndUserId($validatedRequest['characterId'], auth()->id());

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

    public function showToChatHistory(ShowToChatHistoryRequest $request)
    {
        $validatedRequest = $request->validated();

        $chatroom = Chatroom::findOneByChatroomIdAndUserId($validatedRequest['chatroomId'], auth()->id());
        $chats = Chat::findAllByChatroomId($validatedRequest['chatroomId']);
        $characters = Character::findAllByUserId(auth()->id());

        $chatrooms = Chatroom::findAllByUserId(auth()->id());

        return view('home', ['chats' => $chats, 'characters' => $characters, 'chatroom' => $chatroom, 'chatrooms' => $chatrooms]);
    }

    public function createToChat(CreateToChatRequest $request)
    {
        $validatedRequest = $request->validated();

        Chatroom::createChat($validatedRequest['content'], $validatedRequest['chatroomId']);

        return redirect(url()->current());
    }
}
