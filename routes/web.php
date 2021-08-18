<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SecondController;
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

Route::get(
    '/',
    [PagesController::class, 'index']

);
// Route::post(
//     '/',
//     [SecondController::class, 'create']

// );
Route::post(
    '/store',
    [SecondController::class, 'create']

)->name('store');

Route::get('/firstapp', [FirstController::class, 'index']);

// // PEOPLE DATABASE

// // Posting into the database
// Route::post('/people', [FirstController::class, 'create']);

// // Getting data from the database
// Route::get('/people', [FirstController::class, 'people']);

// // Getting single data from the database
// Route::get('/people/{id}', [FirstController::class, 'getSinglePeople']);


// // Updating details in the database
// Route::put('/people/{id}', [FirstController::class, 'update']);

// // Deleting from the database
// Route::delete('/people/{id}', [FirstController::class, 'delete']);

// // --------- //

// // BANK DATABASE

// // Posting into the database
Route::post('/people/createbank', [BankController::class, 'createBank']);

// // Geeting info from the database
// Route::get('/bank', [BankController::class, 'getBank']);

Route::post('/pay', [FirstController::class, 'redirectToGateway'])->name('pay');
