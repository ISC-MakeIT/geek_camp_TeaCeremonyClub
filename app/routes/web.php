<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use App\Models\Chatroom;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/', [HomeController::class, 'showHome']);

    Route::prefix('/character')->group(function () {
        Route::post('/', [CharacterController::class, 'createCharacter']);
    });

    Route::prefix('/chatroom')->group(function () {
        Route::get('/characterElements/{characterId}', [ChatroomController::class, 'showToCreateCharacterElementsForm']);
        Route::get('/create/{characterId}', [ChatroomController::class, 'showToCreateChatroomForm']);
        Route::post('/create/{characterId}', [ChatroomController::class, 'createChatroom']);
    });
});
