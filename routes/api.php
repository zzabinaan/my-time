<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProjectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin'], function ($router) {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
});
Route::group(['prefix' => 'member'], function ($router) {
    Route::post('/login', [MemberController::class, 'login']);
    Route::post('/register', [MemberController::class, 'register']);
});
Route::group(['middleware'=>['jwt.role:admin','jwt.auth'],'prefix'=>'admin'], function($router){
    Route::get('/profile',[AdminController::class,'userProfile']);
    Route::post('/logout',[AdminController::class,'logout']);
    Route::get('/',[ProjectController::class, 'index']);
    Route::post('/store',[ProjectController::class, 'store']);
    Route::get('/show/{id}',[ProjectController::class, 'show']);
    Route::post('/update/{id}',[ProjectController::class, 'update']);
    Route::get('/destroy/{id}',[ProjectController::class, 'destroy']);

});
Route::group(['middleware' => ['jwt.role:member', 'jwt.auth'], 'prefix' => 'member'], function ($router) {
    Route::get('/profile', [MemberController::class, 'userProfile']);
    Route::post('/logout', [MemberController::class, 'logout']);
});

// Register Admin Input Example:
// {
//     "name":"admin",
//     "email":"admin@admin.com",
//     "password":"12345678",
//     "password_confirmation":"12345678"
// }

// Login Admin Input Example:
// {
//     "email":"admin@admin.com",
//     "password":"12345678"
// }

Route::group(["prefix" => "todo"], function () {
    Route::get('/get/{id}', [todoController::class, 'get']);
    Route::get('/gets', [todoController::class, 'gets']);
    Route::post('/store', [todoController::class, 'store']);
    Route::post('/update/{id}', [todoController::class, 'update']);
    Route::delete('/delete/{id}', [todoController::class, 'delete']);
});
