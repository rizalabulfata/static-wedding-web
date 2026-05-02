<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);
Route::get('/api/comments', [GuestController::class, 'fetchComments']);
Route::post('/rsvp', [GuestController::class, 'rsvp']);
Route::post('/comments', [GuestController::class, 'comment']);
