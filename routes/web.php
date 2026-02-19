<?php

use App\Http\Controllers\HomeController;
use App\Livewire\PlayerNotes;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, 
    'reset' => false, 
    'verify' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/players/{player}/notes', PlayerNotes::class)->name('player.notes')->middleware('auth');