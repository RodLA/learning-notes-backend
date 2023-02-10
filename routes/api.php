<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;

// Route::group(["middleware" => "auth:api"], function () {

//     Route::group(['prefix' => 'note'], function () {
//         Route::get('/all', [NoteController::class, 'UserNotes'])->name('api.note.all');
//         Route::post('/store', [NoteController::class, 'store'])->name('api.note.store');
//         Route::post('/update', [NoteController::class, 'update'])->name('api.note.update');
//         Route::delete('/delete/{id}', [NoteController::class, 'delete'])->name('api.note.delete');
//     });
// });

// Route::middleware('auth:api')->get('/me', function (Request $request) {
//     return $request->user();
// });

//                              "clase:metodo"
Route::group( ["middleware" => "auth:api"] , function(){
    Route::get('/me', [UserController::class, 'me'] )->name('api.me');
});

Route::post('/login', [AuthController::class, 'login'] )->name('api.login');
Route::post('/register', [AuthController::class, 'register'] )->name('api.register');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'] )->name('api.forgot-password');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'] )->name('api.reset-password');
