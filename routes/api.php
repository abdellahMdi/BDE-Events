<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SigninController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
// Authentication
Route::post('/login', [SigninController::class, 'signin']);

// Public Event Browsing (Optional: move inside auth if guests shouldn't see events)
Route::get('/events', [EventeController::class, 'displayEvent']);
Route::get('/events/{id}', [EventeController::class, 'showEvent']);


/*
|--------------------------------------------------------------------------
| Protected Student / User Routes (Requires Sanctum Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {

    // Auth Actions
    Route::post('/logout', [SigninController::class, 'logout']);
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    // Tickets & User Reservations
    // Note: It's safer to fetch tickets based on the authenticated token rather than passing {id} in the URL
    Route::get('/my-tickets', [EventeController::class, 'displayTicketByUser']);

    Route::post('/reserve/{id}', [ReservationController::class, 'reservePlace']);
    Route::delete('/cancel/{id}', [ReservationController::class, 'cancelReservation']);


    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {

        // Admin Stats / Dashboard Data
        Route::get('/admin/dashboard', [AdminController::class, 'index']);

        // Event Management CRUD
        Route::post('/admin/events', [EventeController::class, 'createEvent']);
        Route::put('/admin/events/{id}', [EventeController::class, 'updateEvent']);
        Route::delete('/admin/events/{id}', [EventeController::class, 'deleteEvent']);
    });
});
