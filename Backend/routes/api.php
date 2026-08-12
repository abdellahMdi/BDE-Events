<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ReservController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
// Authentication
Route::post('/login', [AuthController::class, 'signin']);

// Public Event Browsing
Route::get('/events', [EventController::class, 'displayEvent']);
Route::get('/events/{id}', [EventController::class, 'showEvent']);

/*
|--------------------------------------------------------------------------
| Protected Student / User Routes (Requires Sanctum Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {

    // Auth Actions
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', function (Request $request) {
        return response()->json([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'role' => $request->user()->role ? strtolower($request->user()->role->label) : 'user',
        ]);
    });

    // Tickets & User Reservations
    Route::get('/my-tickets', [EventController::class, 'displayTicketByUser']);
    Route::post('/reserve/{id}', [ReservController::class, 'reservePlace']);
    Route::delete('/cancel/{id}', [ReservController::class, 'cancelReservation']);

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {

        // Admin Stats / Dashboard Data
        Route::get('/admin/dashboard', [AdminController::class, 'index']);

        // Event Management CRUD
        Route::post('/admin/events', [EventController::class, 'createEvent']);
        Route::put('/admin/events/{id}', [EventController::class, 'updateEvent']);
        Route::delete('/admin/events/{id}', [EventController::class, 'deleteEvent']);
    });
});
