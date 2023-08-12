<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function showHome(): View | Factory
    {
        $characters = Character::findAllByUserId(auth()->id());

        return view('home', ['characters' => $characters]);
    }
}
