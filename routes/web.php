<?php

use App\Http\Controllers\EventeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SigninController;
use Illuminate\Support\Facades\Route;

Route::controller(SigninController::class)->group(function () {
    Route::get("/login", "showPage")->name("loginPage");
    Route::post("/login", "signin")->name("loginLogic");
    Route::post("/logout", "logout")->name("logout");
});

Route::middleware(['auth'])->group(function () {

    Route::controller(EventeController::class)->group(function () {
        Route::get("/events", "displayEvent")->name("dashboardStudent");
        Route::get("/event/details/{id}", "showEvent")->name("showEvent");
        Route::get("/myTickets/{id}", "displayTicketByUser")->name("myTickets");
    });

    Route::controller(ReservationController::class)->group(function () {
        Route::post("/reserve/{id}", "reservePlace")->name("reserveEvent");
        Route::delete("/cancel/{id}", "reservePlace")->name("cancelReservation");
    });

    // ADMIN 
    Route::middleware(['admin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get("/admin/dashboard", "index")->name("adminDashboard");
        });

        Route::controller(EventeController::class)->group(function () {
            Route::get("/admin/addEvent", "createEventPage")->name("addEventPage");
            Route::post("/admin/addEvent", "createEvent")->name("saveEvent");
            Route::get("/admin/editEvent/{id}", "updateEventDisplay")->name("editEventPage");
            Route::put("/admin/editEvent/{id}", "updateEvent")->name("updateEvent");
            Route::delete("/admin/deleteEvent/{id}", "deleteEvent")->name("deleteEvent");
        });

    });
});