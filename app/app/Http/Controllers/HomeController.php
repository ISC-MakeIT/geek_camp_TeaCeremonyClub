<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function showHome(): View | Factory
    {
        $chatrooms = Chatroom::findAllByUserId(auth()->id());

        return view('home', ['chatrooms' => $chatrooms]);
    }
}
