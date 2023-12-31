<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
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
        Route::get('/', [CharacterController::class, 'showToCreateCharacterForm']);
        Route::post('/', [CharacterController::class, 'createCharacter']);
    });

    Route::prefix('/chatroom')->group(function () {
        Route::get('/characterElements', [ChatroomController::class, 'showToCreateCharacterElementsForm']);
        Route::get('/create', [ChatroomController::class, 'showToCreateChatroomForm']);
        Route::post('/create', [ChatroomController::class, 'createChatroom']);

        Route::get('/{chatroomId}/chat', [ChatroomController::class, 'showToChatHistory']);
        Route::post('/{chatroomId}/chat', [ChatroomController::class, 'createToChat']);
    });
});
