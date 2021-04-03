<?php

use Illuminate\Http\Request;
use App\Http\Controllers\NotesController;
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

Route::get('/ping', function(Request $request) {
    return ['pong'=> true];
});

Route::get('/notes', 'NotesController@all');

Route::get('/note/{id}', 'NotesController@one');

Route::post('/note/', 'NotesController@new');

Route::put('/note/{id}', 'NotesController@edit');

Route::delete('/note/{id}', 'NotesController@delete');

