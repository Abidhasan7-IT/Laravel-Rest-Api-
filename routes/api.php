<?php

use App\Http\Controllers\UserApicontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get api for fetch user
Route::get('/users/{id?}', [UserApicontroller::class, 'showUser']);

//post api for add user
Route::post('/add-user', [UserApicontroller::class, 'addUser']);

//post multiple user
Route::post('/add-muluser', [UserApicontroller::class, 'addmulUser']);

//update user
Route::put('/update-user/{id}', [UserApicontroller::class, 'updateUser']);

//delete user
Route::delete('/delete-user/{id}', [UserApicontroller::class, 'deleteUser']);

//delete multiple users
Route::delete('/delete-muluser/{ids}', [UserApicontroller::class, 'deleteMulUser']);

