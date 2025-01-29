<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ScheduleController;

Route::group(['prefix' => 'organizer'], function () {
    Route::get('/all', [OrganizerController::class, 'index'])->name('organizer.index');
    Route::get('/{id}', [OrganizerController::class, 'getById'])->name('organizer.show');
    Route::post('/', [OrganizerController::class, 'store'])->name('organizer.store');
    Route::put('/{id}', [OrganizerController::class, 'update'])->name('organizer.update');
    Route::delete('/{id}', [OrganizerController::class, 'destroy'])->name('organizer.destroy');
});

Route::group(['prefix' => 'event'], function () {
    Route::get('/all', [EventController::class, 'index'])->name('event.index');
    Route::get('/{id}', [EventController::class, 'getById'])->name('event.show');
    Route::post('/', [EventController::class, 'store'])->name('event.store');
    Route::put('/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('/all', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/{id}', [TicketController::class, 'getById'])->name('ticket.show');
    Route::post('/', [TicketController::class, 'store'])->name('ticket.store');
    Route::put('/{id}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
});

Route::group(['prefix' => 'schedule'], function () {
    Route::get('/all', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/{id}', [ScheduleController::class, 'getById'])->name('schedule.show');
    Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});