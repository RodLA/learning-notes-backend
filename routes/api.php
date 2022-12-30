<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::group(["middleware" => "auth:api"], function () {

    Route::group(['prefix' => 'note'], function () {
        Route::get('/all', [NoteController::class, 'UserNotes'])->name('api.note.all');
        Route::post('/store', [NoteController::class, 'store'])->name('api.note.store');
        Route::post('/update', [NoteController::class, 'update'])->name('api.note.update');
        Route::delete('/delete/{id}', [NoteController::class, 'delete'])->name('api.note.delete');
    });
});

Route::post('/login', [AuthController::class, 'login'] )->name('api.login');
Route::post('/register', [AuthController::class, 'register'] )->name('api.register');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'] )->name('api.forgot-password');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'] )->name('api.reset-password');
