<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Game;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [GameController::class, 'showHomePage']);
Route::get('/register', [UserController::class, 'showRegisterForm']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login']);

// ini rada sama kyk kakaknya jadi cek in lagi nanti
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');


Route::get('/createGame',[GameController::class, 'showCreateGamePage']);
Route::post('/createGame',[GameController::class, 'createGame']);

Route::post('/search', [GameController::class, 'searchGame']);

Route::get('/game/{game_id}', [GameController::class, 'gameDetail'])->middleware('checkage');

Route::get('/cart/{game_id}', [GameController::class, 'addCart']);

Route::get('/checkage/{game_id}', [UserController::class, 'showCheckAgePage']);
Route::post('/checkage/{game_id}', [UserController::class, 'checkage']);

Route::get('/cart', [TransactionController::class, 'showShoppingCartPage']);
Route::delete('/cart/{game_id}', [TransactionController::class, 'deleteGameFromCart']);

// Route::get('/gameAdult/{game_id}', [GameController::class, 'checkGameAdult']);
// Route::get('/checkage/{game_id}', [UserController::class, 'showCheckAgePage']);
// Route::post('/checkage/{game_id}', [UserController::class, 'checkAge']);
// Route::get('/game/{game_id}', [GameController::class, 'gameDetail']);

// Route::get('/manageGame', [GameController::class, 'manageGamePage']);
// Route::get('/updateGame/{game_id}', [GameController::class, 'updateGamePage']);
// Route::post('/updateGame/{game_id}', [GameController::class, 'updateGame']);
// Route::delete('/game/{game_id}', [GameController::class, 'deleteGame']);