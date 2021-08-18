<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/firstapp', [FirstController::class, 'index']);

// PEOPLE DATABASE

// Posting into the database
Route::post('/people', [FirstController::class, 'create']);

// Getting data from the database
Route::get('/people', [FirstController::class, 'people']);

// Getting single data from the database
Route::get('/people/{id}', [FirstController::class, 'getSinglePeople']);


// Updating details in the database
Route::put('/people/{id}', [FirstController::class, 'update']);

// Deleting from the database
Route::delete('/people/{id}', [FirstController::class, 'delete']);

// --------- //

// BANK DATABASE

// Posting into the database
Route::post('/people/createbank', [BankController::class, 'createBank']);

// Geeting info from the database
Route::get('/bank', [BankController::class, 'getBank']);