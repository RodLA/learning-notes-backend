<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;

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
