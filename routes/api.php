<?php

use App\Http\Controllers\Api\AdConrtoller;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
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



## ----------------------------------------------- AUTH MODULE
Route::controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

## ----------------------------------------------- SETTINGS MODULE
Route::get('/settings', SettingController::class);

## ----------------------------------------------- CITIES MODULE
Route::get('/cities', CityController::class);

## ----------------------------------------------- DISTRICT MODULE
Route::get('/districts/{city_id}', DistrictController::class);

## ----------------------------------------------- MESSAGES MODULE
Route::post('/messages', MessageController::class);

## ----------------------------------------------- DOMAIN MODULE
Route::get('/domains', DomainController::class);

## ----------------------------------------------- ADS MODULE
Route::prefix('ads')->controller(AdConrtoller::class)->group(function () {
    // basic
    Route::get('/', 'index');
    Route::get('/latest', 'latest');
    Route::get('/domain/{domain_id}', 'domain');
    Route::get('/search', 'search');
    //user api ads endpoint
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', 'create');
        Route::post('update/{adId}', 'update');
        Route::get('delete/{adId}', 'delete');
        Route::get('myads', 'myads');
    });
});
