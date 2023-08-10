<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCharacterRequest;

class CreateCharacterController extends Controller
{
    public function createCharacterValidates(CreateCharacterRequest $request)
    {
        return redirect()->route("createCharacter", ['msg' => 'OK']);
    }
}
