<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;


Route::get('/', [AppController::class, 'index'])->name('app.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'showProfile'])->name('app.author.profile');
        Route::get('/manage', [ProfileController::class, 'manageProfile'])->name('app.author.manage-author');
        Route::put('/update', [AuthController::class, 'update'])->name('auth.update');
        Route::delete('/delete', [AuthController::class, 'destroy'])->name('auth.destroy');
    });

    Route::prefix('books')->group(function () {
        Route::get('/manage', [BooksController::class, 'manage'])->name('app.author.manage-book');
        Route::get('/register', [BooksController::class, 'create'])->name('app.author.register-book');
        Route::post('/register', [BooksController::class, 'store'])->name('books.store');

        Route::get('/{id}/edit', [BooksController::class, 'edit'])->name('books.edit');
        Route::put('/{id}', [BooksController::class, 'update'])->name('books.update');
        Route::delete('/{id}', [BooksController::class, 'destroy'])->name('books.destroy');
    });
});

Route::get('/books/{id}', [BooksController::class, 'details'])->name('app.books.details');


Route::fallback(function () {
    return redirect()->route('app.index')->with('error', 'Página não encontrada.');
});
