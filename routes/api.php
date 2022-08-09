<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\MemberController;

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

Route::group(['prefix'=>'admin'], function($router){
    Route::post('/login',[AdminController::class,'login']);
    Route::post('/register',[AdminController::class,'register']);
});
Route::group(['prefix'=>'subadmin'], function($router){
    Route::post('/login',[SubAdminController::class,'login']);
    Route::post('/register',[SubAdminController::class,'register']);
});
Route::group(['prefix'=>'member'], function($router){
    Route::post('/login',[MemberController::class,'login']);
    Route::post('/register',[MemberController::class,'register']);
});
Route::group(['middleware'=>['jwt.role:admin','jwt.auth'],'prefix'=>'admin'], function($router){
    Route::get('/user-profile',[AdminController::class,'userProfile']);
    Route::post('/logout',[AdminController::class,'logout']);
});
Route::group(['middleware'=>['jwt.role:subadmin','jwt.auth'],'prefix'=>'subadmin'], function($router){
    Route::get('/user-profile',[SubAdminController::class,'userProfile']);
    Route::post('/logout',[SubAdminController::class,'logout']);
});
Route::group(['middleware'=>['jwt.role:member','jwt.auth'],'prefix'=>'member'], function($router){
    Route::get('/user-profile',[MemberController::class,'userProfile']);
    Route::post('/logout',[MemberController::class,'logout']);
});