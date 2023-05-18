<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/students/store', 'App\Http\Controllers\api\v1\StudentController@store');
Route::get('/v1/students', 'App\Http\Controllers\api\v1\StudentController@index');
Route::get('/v1/students/{id?}', 'App\Http\Controllers\api\v1\StudentController@show');
Route::post('/v1/students/update', 'App\Http\Controllers\api\v1\StudentController@update');
Route::delete('/v1/students/delete/{id?}', 'App\Http\Controllers\api\v1\StudentController@destroy');
